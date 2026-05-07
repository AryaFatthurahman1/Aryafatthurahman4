<?php
declare(strict_types=1);

function portal_h(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function portal_money(float|int|string|null $value): string
{
    return 'Rp ' . number_format((float) ($value ?? 0), 0, ',', '.');
}

function portal_number(float|int|string|null $value): string
{
    return number_format((float) ($value ?? 0), 0, ',', '.');
}

function portal_url(string $path = '/'): string
{
    $trimmed = trim($path);

    if ($trimmed === '' || $trimmed === '/') {
        return '/';
    }

    $hasTrailingSlash = str_ends_with($trimmed, '/');
    $segments = array_filter(explode('/', trim($trimmed, '/')), static fn (string $segment): bool => $segment !== '');
    $encoded = array_map(static fn (string $segment): string => rawurlencode($segment), $segments);

    return '/' . implode('/', $encoded) . ($hasTrailingSlash ? '/' : '');
}

function portal_server_pdo(): ?PDO
{
    static $pdo = false;

    if ($pdo !== false) {
        return $pdo instanceof PDO ? $pdo : null;
    }

    try {
        $pdo = new PDO(
            'mysql:host=127.0.0.1;charset=utf8mb4',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    } catch (Throwable) {
        $pdo = null;
    }

    return $pdo;
}

function portal_db_pdo(string $database): ?PDO
{
    static $cache = [];

    if (array_key_exists($database, $cache)) {
        return $cache[$database];
    }

    try {
        $cache[$database] = new PDO(
            sprintf('mysql:host=127.0.0.1;dbname=%s;charset=utf8mb4', $database),
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    } catch (Throwable) {
        $cache[$database] = null;
    }

    return $cache[$database];
}

function portal_database_exists(string $database): bool
{
    $pdo = portal_server_pdo();

    if ($pdo === null) {
        return false;
    }

    try {
        $statement = $pdo->prepare(
            'SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ? LIMIT 1'
        );
        $statement->execute([$database]);

        return (bool) $statement->fetchColumn();
    } catch (Throwable) {
        return false;
    }
}

function portal_value(?PDO $pdo, string $sql, array $params = [], mixed $default = 0): mixed
{
    if ($pdo === null) {
        return $default;
    }

    try {
        $statement = $pdo->prepare($sql);
        $statement->execute($params);
        $value = $statement->fetchColumn();

        return $value === false ? $default : $value;
    } catch (Throwable) {
        return $default;
    }
}

function portal_rows(?PDO $pdo, string $sql, array $params = []): array
{
    if ($pdo === null) {
        return [];
    }

    try {
        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        return $statement->fetchAll() ?: [];
    } catch (Throwable) {
        return [];
    }
}
