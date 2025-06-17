<?php

namespace App\Http\Controllers;

use App\Models\Abc;
use App\Models\ClassModel;
use App\Models\Location;
use App\Traits\UpdateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UpdateHelper;
    public function index(Request $request)
    {

        $levels = [10, 11, 12];
        $majors = ['RPL', 'ORACLE', 'GAMELAB'];
        $abcs = Abc::pluck('abc_name', 'abc_id');
        $locations = Location::where('type', '=', 'class')->pluck('location_name', 'location_id');


        $search = $request->query('search');
        $selectedLevel = $request->query('levels', []);

        $classes = DB::table('vclasses')
        ->leftJoin('students', 'vclasses.class_id', '=', 'students.class_id')
        ->select(
            'vclasses.class_id',
            'vclasses.class_name',
            'vclasses.level',
            'vclasses.major',
            'vclasses.abc_name',
            'vclasses.class_location',
            'vclasses.slug_class',
            DB::raw('COUNT(students.nisn) as student_count') // Hitung jumlah siswa
        )
        ->when(!empty($selectedLevel), function ($query) use ($selectedLevel) {
            $query->whereIn('level', $selectedLevel);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('class_name', 'like', '%' . $search . '%');
        })->groupBy(
            'vclasses.class_id',
            'vclasses.class_name',
            'vclasses.level',
            'vclasses.major',
            'vclasses.abc_name',
            'vclasses.class_location',
            'vclasses.slug_class'
        )->paginate(12);

        if ($request->ajax()) {
            $paginationHtml = view('components.pagination', [
                'paginator' => $classes,
                'RouteName' => 'classes.index',
                'RouteParams' => $request->except('page'),
            ])->render();

            return response()->json([
                'html' => view('classes.partials._class-list', compact('classes'))->render(),
                'pagination' => $paginationHtml,
                'level' => $selectedLevel,
                'search' => $search,
            ]);
        }
        return view('classes.index', compact('classes', 'levels', 'majors', 'abcs', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'level' => 'required|in:10,11,12',
            'major' => 'required|in:RPL,ORACLE,GAMELAB',
            'abc_id' => 'required|exists:abcs,abc_id',
            'location_id' => 'required|exists:locations,location_id',
        ]);

        ClassModel::create([
            'level' => $validatedData['level'],
            'major' => $validatedData['major'],
            'abc_id' => $validatedData['abc_id'],
            'location_id' => $validatedData['location_id'],
        ]);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug_class)
    {
        // 1. Dapatkan class berdasarkan slug
    $class = DB::table('vclasses')->where('slug_class', $slug_class)->firstOrFail();

    // 2. Ambil students berdasarkan class_name dari view
    $students = DB::table('vstudents')->where('class_name', $class->class_name)
        ->orderBy('student_name')
        ->paginate(10);

        return view('students.index', compact('class','students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // Validasi (sama seperti sebelumnya)
            $request->validate([
                'classes' => 'required|array',
                'classes.*.selected' => 'required_if:classes.*.selected,1',
                'classes.*.level' => 'required_if:classes.*.selected,1|in:10,11,12',
                'classes.*.major' => 'required_if:classes.*.selected,1|in:RPL,ORACLE,GAMELAB',
                'classes.*.abc_id' => 'required_if:classes.*.selected,1|exists:abcs,abc_id',
                'classes.*.location_id' => 'required_if:classes.*.selected,1|exists:locations,location_id',
            ]);

            // Siapkan data per field
            $fields = ['level', 'major', 'abc_id', 'location_id'];
            $updates = array_fill_keys($fields, []);
            $ids = [];

            foreach ($request->input('classes', []) as $classId => $data) {
                if (isset($data['selected'])) {
                    $ids[] = $classId;

                    foreach ($fields as $field) {
                        if (isset($data[$field])) {
                            $updates[$field][$classId] = $data[$field];
                        }
                    }
                }
            }

            if (!empty($ids)) {
                $updateData = [];

                // Gunakan trait buildCaseStatement untuk setiap field
                foreach ($fields as $field) {
                    if (!empty($updates[$field])) {
                        $updateData[$field] = $this->buildCaseStatement($updates[$field], 'class_id');
                    }
                }

                if (!empty($updateData)) {
                    ClassModel::whereIn('class_id', $ids)->update($updateData);
                }
            }

            return redirect()->route('classes.index')->with('success', 'Data kelas berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->route('classes.index')->with('error', 'Gagal memperbarui kelas: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'classes' => 'required|array',
                'classes.*' => 'exists:classes,class_id',
            ]);
    
            $classIds = $request->input('classes');
    
            // Hapus kelas
            ClassModel::whereIn('class_id', $classIds)->delete();
    
            return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('classes.index')->with('error', 'Gagal menghapus kelas: ' . $e->getMessage());
        }
    }
}
