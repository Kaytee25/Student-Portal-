<?php

declare(strict_types=1);

const PORTAL_DB_HOST = '127.0.0.1';
const PORTAL_DB_PORT = '3306';
const PORTAL_DB_NAME = 'student_portal_project';
const PORTAL_DB_USER = 'root';
const PORTAL_DB_PASS = '';

function portal_json_encode(mixed $value): string
{
    return json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '[]';
}

function portal_json_decode(string|null $value, mixed $default = []): mixed
{
    if ($value === null || $value === '') {
        return $default;
    }

    $decoded = json_decode($value, true);
    return json_last_error() === JSON_ERROR_NONE ? $decoded : $default;
}

function portal_seed_student(): array
{
    return [
        'studentNumber' => 'N02529721P',
        'password' => 'nust1234',
        'fullName' => 'Tapiwa Chigome',
        'surname' => 'Chigome',
        'givenNames' => 'Tapiwa',
        'gender' => 'Female',
        'nationalId' => '63-2600955H58',
        'dateOfBirth' => '2006-01-09',
        'placeOfBirth' => 'Kwekwe',
        'programme' => 'Bachelor of Science Honours Degree in Computer Science',
        'programmeCode' => 'SCS',
        'email' => 'tapiwa.chigome@nust.ac.zw',
        'phone' => '263772739852',
        'addressLines' => ['Victoria Range', 'Masvingo', 'Zimbabwe'],
        'currentAcademicYear' => '2026',
        'currentPart' => '2',
        'currentSemester' => '1',
        'transcriptCleared' => 'No',
        'feesPaid' => 395.27,
        'paymentPlan' => 'You are not on Payment Plan!',
        'libraryFines' => '',
        'itemsOwed' => '',
        'registrationHistory' => [],
        'courses' => [
            ['courseCode' => 'SCS2201', 'courseName' => 'Advanced Programming Concepts', 'type' => 'CORE'],
            ['courseCode' => 'SCS2202', 'courseName' => 'Systems Analysis and Design II', 'type' => 'CORE'],
            ['courseCode' => 'SCS2203', 'courseName' => 'Software Project Management', 'type' => 'CORE'],
        ],
        'continuousAssessment' => [
            ['academicYear' => '2025', 'courseCode' => 'SCS1101', 'courseName' => 'Introduction to Computer Science and Programming', 'description' => 'Overall Assessment', 'type' => 'Contributing', 'mark' => '72.00'],
            ['academicYear' => '2025', 'courseCode' => 'SCS1213', 'courseName' => 'Database Systems', 'description' => 'Overall', 'type' => 'Aggregating', 'mark' => '86.00'],
        ],
        'examResults' => [
            ['academicYear' => '2025', 'part' => '1', 'semester' => '1', 'entryType' => 'COURSE', 'courseCode' => 'SCS1101', 'courseName' => 'Introduction to Computer Science and Programming', 'mark' => '88.00', 'classification' => '1', 'credits' => '12', 'remark' => 'Pass'],
            ['academicYear' => '2025', 'part' => '1', 'semester' => '2', 'entryType' => 'COURSE', 'courseCode' => 'SCS1213', 'courseName' => 'Database Systems', 'mark' => '76.00', 'classification' => '1', 'credits' => '10', 'remark' => 'Pass'],
        ],
        'ledger' => [
            ['date' => '2026-04-25', 'type' => 'PAYMENT', 'description' => 'Tuition Fees', 'currencyCode' => 'ZIG', 'amount' => -7200, 'usdEquivalent' => -285.51],
            ['date' => '2026-04-26', 'type' => 'INVOICE', 'description' => 'UG-P2SP1-SCS-2025-BYO-1-Y2-S1', 'currencyCode' => 'USD', 'amount' => 745, 'usdEquivalent' => 745],
        ],
        'createdAt' => '2026-05-29',
    ];
}

function portal_seed_admin(): array
{
    return [
        'username' => 'admin',
        'password' => 'admin123',
        'fullName' => 'Portal Administrator',
    ];
}

function portal_connection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $server = new PDO(
        sprintf('mysql:host=%s;port=%s;charset=utf8mb4', PORTAL_DB_HOST, PORTAL_DB_PORT),
        PORTAL_DB_USER,
        PORTAL_DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    $server->exec(sprintf(
        'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci',
        PORTAL_DB_NAME
    ));

    $pdo = new PDO(
        sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', PORTAL_DB_HOST, PORTAL_DB_PORT, PORTAL_DB_NAME),
        PORTAL_DB_USER,
        PORTAL_DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    portal_initialize_schema($pdo);
    return $pdo;
}

function portal_initialize_schema(PDO $pdo): void
{
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS students (
            student_number VARCHAR(32) PRIMARY KEY,
            password_hash VARCHAR(255) NOT NULL,
            full_name VARCHAR(255) NOT NULL,
            surname VARCHAR(255) NOT NULL,
            given_names VARCHAR(255) NOT NULL,
            gender VARCHAR(64) NOT NULL,
            national_id VARCHAR(64) NOT NULL,
            date_of_birth VARCHAR(32) NOT NULL,
            place_of_birth VARCHAR(128) NOT NULL,
            programme VARCHAR(255) NOT NULL,
            programme_code VARCHAR(32) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(64) NOT NULL,
            address_lines_json LONGTEXT NOT NULL,
            current_academic_year VARCHAR(16) NOT NULL,
            current_part VARCHAR(16) NOT NULL,
            current_semester VARCHAR(16) NOT NULL,
            transcript_cleared VARCHAR(32) NOT NULL,
            fees_paid DECIMAL(10,2) NOT NULL DEFAULT 0,
            payment_plan VARCHAR(255) NOT NULL,
            library_fines VARCHAR(255) NOT NULL,
            items_owed VARCHAR(255) NOT NULL,
            registration_history_json LONGTEXT NOT NULL,
            courses_json LONGTEXT NOT NULL,
            continuous_assessment_json LONGTEXT NOT NULL,
            exam_results_json LONGTEXT NOT NULL,
            ledger_json LONGTEXT NOT NULL,
            created_at VARCHAR(32) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
    );

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS admins (
            username VARCHAR(64) PRIMARY KEY,
            password_hash VARCHAR(255) NOT NULL,
            full_name VARCHAR(255) NOT NULL,
            created_at VARCHAR(32) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
    );

    $studentCount = (int) $pdo->query('SELECT COUNT(*) AS total FROM students')->fetch()['total'];
    if ($studentCount === 0) {
        portal_replace_students($pdo, [portal_seed_student()]);
    }

    $adminCount = (int) $pdo->query('SELECT COUNT(*) AS total FROM admins')->fetch()['total'];
    if ($adminCount === 0) {
        $admin = portal_seed_admin();
        $statement = $pdo->prepare('INSERT INTO admins (username, password_hash, full_name, created_at) VALUES (:username, :password_hash, :full_name, :created_at)');
        $statement->execute([
            'username' => $admin['username'],
            'password_hash' => password_hash($admin['password'], PASSWORD_DEFAULT),
            'full_name' => $admin['fullName'],
            'created_at' => date('Y-m-d'),
        ]);
    }
}

function portal_student_row_to_public(array $row): array
{
    return [
        'studentNumber' => $row['student_number'],
        'fullName' => $row['full_name'],
        'surname' => $row['surname'],
        'givenNames' => $row['given_names'],
        'gender' => $row['gender'],
        'nationalId' => $row['national_id'],
        'dateOfBirth' => $row['date_of_birth'],
        'placeOfBirth' => $row['place_of_birth'],
        'programme' => $row['programme'],
        'programmeCode' => $row['programme_code'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'addressLines' => portal_json_decode($row['address_lines_json'], []),
        'currentAcademicYear' => $row['current_academic_year'],
        'currentPart' => $row['current_part'],
        'currentSemester' => $row['current_semester'],
        'transcriptCleared' => $row['transcript_cleared'],
        'feesPaid' => (float) $row['fees_paid'],
        'paymentPlan' => $row['payment_plan'],
        'libraryFines' => $row['library_fines'],
        'itemsOwed' => $row['items_owed'],
        'registrationHistory' => portal_json_decode($row['registration_history_json'], []),
        'courses' => portal_json_decode($row['courses_json'], []),
        'continuousAssessment' => portal_json_decode($row['continuous_assessment_json'], []),
        'examResults' => portal_json_decode($row['exam_results_json'], []),
        'ledger' => portal_json_decode($row['ledger_json'], []),
        'createdAt' => $row['created_at'],
    ];
}

function portal_fetch_students(PDO $pdo): array
{
    $statement = $pdo->query('SELECT * FROM students ORDER BY created_at DESC, student_number ASC');
    return array_map('portal_student_row_to_public', $statement->fetchAll());
}

function portal_bootstrap_students(PDO $pdo): array
{
    return portal_fetch_students($pdo);
}

function portal_student_payload(array $student, array $existingHashes = []): array
{
    $studentNumber = strtoupper(trim((string) ($student['studentNumber'] ?? '')));
    $existingHash = $existingHashes[$studentNumber] ?? null;
    $password = trim((string) ($student['password'] ?? ''));

    return [
        'student_number' => $studentNumber,
        'password_hash' => $password !== '' ? password_hash($password, PASSWORD_DEFAULT) : ($existingHash ?? password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT)),
        'full_name' => trim((string) ($student['fullName'] ?? '')),
        'surname' => trim((string) ($student['surname'] ?? '')),
        'given_names' => trim((string) ($student['givenNames'] ?? '')),
        'gender' => trim((string) ($student['gender'] ?? '')),
        'national_id' => trim((string) ($student['nationalId'] ?? '')),
        'date_of_birth' => trim((string) ($student['dateOfBirth'] ?? '')),
        'place_of_birth' => trim((string) ($student['placeOfBirth'] ?? '')),
        'programme' => trim((string) ($student['programme'] ?? '')),
        'programme_code' => trim((string) ($student['programmeCode'] ?? '')),
        'email' => trim((string) ($student['email'] ?? '')),
        'phone' => trim((string) ($student['phone'] ?? '')),
        'address_lines_json' => portal_json_encode(array_values((array) ($student['addressLines'] ?? []))),
        'current_academic_year' => trim((string) ($student['currentAcademicYear'] ?? '2026')),
        'current_part' => trim((string) ($student['currentPart'] ?? '1')),
        'current_semester' => trim((string) ($student['currentSemester'] ?? '1')),
        'transcript_cleared' => trim((string) ($student['transcriptCleared'] ?? 'No')),
        'fees_paid' => (float) ($student['feesPaid'] ?? 0),
        'payment_plan' => trim((string) ($student['paymentPlan'] ?? 'You are not on Payment Plan!')),
        'library_fines' => trim((string) ($student['libraryFines'] ?? '')),
        'items_owed' => trim((string) ($student['itemsOwed'] ?? '')),
        'registration_history_json' => portal_json_encode(array_values((array) ($student['registrationHistory'] ?? []))),
        'courses_json' => portal_json_encode(array_values((array) ($student['courses'] ?? []))),
        'continuous_assessment_json' => portal_json_encode(array_values((array) ($student['continuousAssessment'] ?? []))),
        'exam_results_json' => portal_json_encode(array_values((array) ($student['examResults'] ?? []))),
        'ledger_json' => portal_json_encode(array_values((array) ($student['ledger'] ?? []))),
        'created_at' => trim((string) ($student['createdAt'] ?? date('Y-m-d'))),
    ];
}

function portal_replace_students(PDO $pdo, array $students): void
{
    $existingHashes = [];
    foreach ($pdo->query('SELECT student_number, password_hash FROM students') as $row) {
        $existingHashes[$row['student_number']] = $row['password_hash'];
    }

    $pdo->beginTransaction();
    try {
        $pdo->exec('DELETE FROM students');
        $statement = $pdo->prepare(
            'INSERT INTO students (
                student_number, password_hash, full_name, surname, given_names, gender, national_id, date_of_birth,
                place_of_birth, programme, programme_code, email, phone, address_lines_json, current_academic_year,
                current_part, current_semester, transcript_cleared, fees_paid, payment_plan, library_fines, items_owed,
                registration_history_json, courses_json, continuous_assessment_json, exam_results_json, ledger_json, created_at
            ) VALUES (
                :student_number, :password_hash, :full_name, :surname, :given_names, :gender, :national_id, :date_of_birth,
                :place_of_birth, :programme, :programme_code, :email, :phone, :address_lines_json, :current_academic_year,
                :current_part, :current_semester, :transcript_cleared, :fees_paid, :payment_plan, :library_fines, :items_owed,
                :registration_history_json, :courses_json, :continuous_assessment_json, :exam_results_json, :ledger_json, :created_at
            )'
        );

        foreach ($students as $student) {
            $payload = portal_student_payload($student, $existingHashes);
            $statement->execute($payload);
        }

        $pdo->commit();
    } catch (Throwable $throwable) {
        $pdo->rollBack();
        throw $throwable;
    }
}

function portal_login_student(PDO $pdo, string $identifier, string $password): ?array
{
    $statement = $pdo->prepare('SELECT * FROM students WHERE student_number = :student_number LIMIT 1');
    $statement->execute(['student_number' => strtoupper(trim($identifier))]);
    $row = $statement->fetch();

    if (!$row || !password_verify($password, $row['password_hash'])) {
        return null;
    }

    return portal_student_row_to_public($row);
}

function portal_login_admin(PDO $pdo, string $username, string $password): ?array
{
    $statement = $pdo->prepare('SELECT * FROM admins WHERE username = :username LIMIT 1');
    $statement->execute(['username' => trim($username)]);
    $row = $statement->fetch();

    if (!$row || !password_verify($password, $row['password_hash'])) {
        return null;
    }

    return [
        'username' => $row['username'],
        'fullName' => $row['full_name'],
        'createdAt' => $row['created_at'],
    ];
}
