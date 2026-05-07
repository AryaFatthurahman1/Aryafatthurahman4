$repos = @(
    "arya2", "aryafatthur", "aryafatthur3", "Aryafatthur5", "AryaFatthurahman1",
    "belajar-python-server", "Genspark-Web1", "Interdimensional-Site", "jakarta-luxury-ai",
    "MIA-Migrant-Indonesia-Assistant", "Modern-City1", "project_hotel",
    "UAS-Pemrograman-Web-Lanjutan", "Website-Personal", "Website-Personal1"
)

foreach ($repo in $repos) {
    if (Test-Path $repo) {
        Write-Host "Skipping $repo (already exists)"
    } else {
        Write-Host "Cloning $repo..."
        git clone "https://github.com/AryaFatthurahman1/$repo.git"
    }
}
