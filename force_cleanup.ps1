# Aggressive .git removal
$currentDir = Get-Location
Get-ChildItem -Path . -Recurse -Hidden -Directory -Filter ".git" -ErrorAction SilentlyContinue | ForEach-Object {
    if ($_.FullName -ne (Join-Path $currentDir ".git")) {
        Write-Host "Forcing removal of $($_.FullName)..."
        # Set attributes to normal to allow deletion of read-only files inside .git
        Get-ChildItem -Path $_.FullName -Recurse -Force | ForEach-Object { $_.Attributes = 'Normal' }
        Remove-Item -Path $_.FullName -Recurse -Force -ErrorAction SilentlyContinue
    }
}

# Handle the WebsiteBaru issue specifically if it's an empty git repo
if (Test-Path "WebsiteBaru/.git") {
    Write-Host "Cleaning WebsiteBaru..."
    Get-ChildItem -Path "WebsiteBaru/.git" -Recurse -Force | ForEach-Object { $_.Attributes = 'Normal' }
    Remove-Item -Path "WebsiteBaru/.git" -Recurse -Force -ErrorAction SilentlyContinue
}

git init
git add .
git commit -m "Initial commit of all www files (flattened)"
