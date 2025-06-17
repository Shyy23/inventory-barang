-- CTE LOCATION
WITH RankedObjects AS (
    SELECT 
        location_id,
        location_name,
        type,
        object_name,
        ROW_NUMBER() OVER (
            PARTITION BY location_name 
            ORDER BY object_name -- Ganti dengan kolom yang sesuai
        ) AS row_num
    FROM vlocations
)
SELECT 
    location_id,
    location_name,
    type,
    object_name
FROM RankedObjects
WHERE row_num <= 3;
