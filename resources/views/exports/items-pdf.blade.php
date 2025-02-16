<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Barang</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            th {
                background-color: rgba(67, 94, 190, 1);
                color: #fff;
            }
        </style>
    </head>
    <body>
        <h1>Daftar Barang</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>kategori</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->location_name }}</td>
                        <td>{{ $item->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
