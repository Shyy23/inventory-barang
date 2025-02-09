-- view

CREATE OR REPLACE 
VIEW `vclass_loans` AS 
SELECT 
    cl.class_loan_id AS class_loan_id,
    ll.student_name AS student_name,
    ll.item_name,
    ll.item_quantity,
    ll.unit_name,
    c.class_name AS class_name,
    s.subject_name AS subject_name,
    ll.loan_id
FROM 
    class_loans cl
JOIN 
    vloan_details ll ON cl.loan_detail_id = ll.loan_detail_id
JOIN 
    vclasses c ON cl.class_id = c.class_id
JOIN 
    subjects s ON cl.subject_id = s.subject_id;


CREATE OR REPLACE VIEW `vloan_details` AS 
SELECT 
    ld.loan_detail_id,
    ll.student_name,
    ll.loan_status,
    i.item_name,
    iu.unit_name,
    ld.item_quantity,
    ld.loan_description,
    ll.return_time,
    ll.updated_at,
    ll.loan_date,
    ll.loan_id
FROM 
    loan_details ld
JOIN 
    vloan_logs ll ON ld.loan_id = ll.loan_id
JOIN 
    vitems i ON ld.item_id = i.item_id
LEFT JOIN 
    vitem_units iu ON ld.unit_id = iu.unit_id;

SELECT 
    ld.loan_detail_id,
    ll.student_name,
    i.item_name,
    COALESCE(iu.unit_name, 'Tidak ada satuan') AS unit_name, -- Handle NULL unit
    ld.item_quantity,
    ll.return_time,
    ll.loan_date,
    ll.loan_id,
    -- Jika tidak ada data di vclass_loans, tampilkan teks default
    COALESCE(
        GROUP_CONCAT(
            CONCAT(cl.class_name, ' - ', cl.subject_name) 
            SEPARATOR ', '
        ), 
        'Tidak terkait kelas'
    ) AS learning,
    'delayed' AS status_loan
FROM 
    loan_details ld
JOIN 
    vloan_logs ll ON ld.loan_id = ll.loan_id
JOIN 
    vitems i ON ld.item_id = i.item_id
LEFT JOIN 
    vitem_units iu ON ld.unit_id = iu.unit_id
LEFT JOIN 
    vclass_loans cl ON ld.loan_detail_id = cl.loan_detail_id
WHERE 
    ll.loan_status = 'delayed'
GROUP BY 
    ld.loan_detail_id,
    ll.student_name,
    i.item_name,
    iu.unit_name,
    ld.item_quantity,
    ll.return_time,
    ll.loan_date,
    ll.loan_id;