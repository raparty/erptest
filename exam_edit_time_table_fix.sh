#!/bin/bash
# Add sanitization block after line 7
sed -i '7 a\$sid = (int)($_GET[\x27sid\x27] ?? 0);\n' exam_edit_time_table.php

# Replace POST and GET references with sanitized versions
sed -i 's/\$_POST\[\x27class\x27\]/\$safe_class/g' exam_edit_time_table.php
sed -i 's/\$_POST\[\x27stream\x27\]/\$safe_stream/g' exam_edit_time_table.php
sed -i 's/\$_POST\[\x27subject_id\x27\]/\$safe_subject_id/g' exam_edit_time_table.php
sed -i 's/\$_POST\[\x27date\x27\]/\$safe_date/g' exam_edit_time_table.php
sed -i 's/\$_GET\[\x27sid\x27\]/\$sid/g' exam_edit_time_table.php

# Add sanitization code after the POST check
sed -i '9 a\\t// Sanitize POST inputs to prevent SQL injection\n\t$safe_class = db_escape($_POST[\x27class\x27] ?? \x27\x27);\n\t$safe_stream = db_escape($_POST[\x27stream\x27] ?? \x27\x27);\n\t$safe_subject_id = db_escape($_POST[\x27subject_id\x27] ?? \x27\x27);\n\t$safe_date = db_escape($_POST[\x27date\x27] ?? \x27\x27);' exam_edit_time_table.php
