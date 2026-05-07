# Find all .git directories in subfolders (but not the root one if it exists)
Get-ChildItem -Path . -Recurse -Directory -Filter ".git" -ErrorAction SilentlyContinue | Where-Object { $_.FullName -ne (Join-Path (Get-Location) ".git") } | ForEach-Object {
    Write-Host "Removing $($_.FullName)..."
    Remove-Item -Path $_.FullName -Recurse -Force -ErrorAction SilentlyContinue
}

# Also check for empty folders or broken git pointers
git init
git add .
git commit -m "Initial commit of all www files"
