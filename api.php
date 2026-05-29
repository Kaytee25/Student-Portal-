<?php

declare(strict_types=1);

require_once __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');

function portal_request_data(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === false || trim($raw) === '') {
        return array_merge($_GET, $_POST);
    }

    $decoded = json_decode($raw, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        return array_merge($_GET, $_POST, $decoded);
    }

    parse_str($raw, $parsed);
    return array_merge($_GET, $_POST, $parsed);
}

function portal_json_response(array $payload, int $status = 200): never
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $pdo = portal_connection();
    $request = portal_request_data();
    $action = (string) ($request['action'] ?? '');

    if ($action === 'login') {
        $role = (string) ($request['role'] ?? 'student');
        $identifier = (string) ($request['identifier'] ?? '');
        $password = (string) ($request['password'] ?? '');

        if ($role === 'admin') {
            $admin = portal_login_admin($pdo, $identifier, $password);
            if ($admin === null) {
                portal_json_response(['ok' => false, 'message' => 'Invalid admin username or password.'], 401);
            }

            portal_json_response(['ok' => true, 'role' => 'admin', 'admin' => $admin]);
        }

        $student = portal_login_student($pdo, $identifier, $password);
        if ($student === null) {
            portal_json_response(['ok' => false, 'message' => 'Invalid student number or password.'], 401);
        }

        portal_json_response(['ok' => true, 'role' => 'student', 'student' => $student]);
    }

    if ($action === 'syncStudents') {
        $students = $request['students'] ?? [];
        if (!is_array($students)) {
            portal_json_response(['ok' => false, 'message' => 'Invalid student payload.'], 400);
        }

        portal_replace_students($pdo, $students);
        portal_json_response(['ok' => true, 'students' => portal_bootstrap_students($pdo)]);
    }

    if ($action === 'students') {
        portal_json_response(['ok' => true, 'students' => portal_bootstrap_students($pdo)]);
    }

    portal_json_response(['ok' => false, 'message' => 'Unknown action.'], 400);
} catch (Throwable $throwable) {
    portal_json_response([
        'ok' => false,
        'message' => 'Database error: ' . $throwable->getMessage(),
    ], 500);
}
