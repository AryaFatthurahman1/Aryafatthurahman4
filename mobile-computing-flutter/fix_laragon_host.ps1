$hostsPath = 'C:\Windows\System32\drivers\etc\hosts'
$entry = '127.0.0.1 mobile-computing-flutter.test'
$aliasEntry = '127.0.0.1 www.mobile-computing-flutter.test'

if (-not ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)) {
    Write-Host 'Jalankan script ini sebagai Administrator.' -ForegroundColor Yellow
    exit 1
}

$content = Get-Content -Path $hostsPath -ErrorAction Stop

if ($content -notmatch 'mobile-computing-flutter\.test') {
    Add-Content -Path $hostsPath -Value "`r`n$entry"
    Add-Content -Path $hostsPath -Value $aliasEntry
    Write-Host 'Host Laragon berhasil ditambahkan.' -ForegroundColor Green
} else {
    Write-Host 'Host Laragon sudah ada, tidak perlu ditambah lagi.' -ForegroundColor Cyan
}

Write-Host 'Sekarang restart Apache di Laragon lalu buka http://mobile-computing-flutter.test/' -ForegroundColor White
