$repos = @("arya2", "aryafatthur", "aryafatthur3", "Aryafatthur5", "AryaFatthurahman1", "belajar-python-server", "Genspark-Web1", "Interdimensional-Site", "jakarta-luxury-ai", "MIA-Migrant-Indonesia-Assistant", "Modern-City1", "project_hotel", "UAS-Pemrograman-Web-Lanjutan", "Website-Personal", "Website-Personal1")

foreach ($repo in $repos) {
    $path = "d:\laragon\www\$repo"
    if (Test-Path $path) {
        cd $path
        if (Test-Path .git) {
            git add .
            git commit -m "Update files from laptop"
            git push
        } else {
            git init
            git add .
            git commit -m "Initial commit from laptop"
            git remote add origin "https://github.com/AryaFatthurahman1/$repo.git"
            git push -u origin main
        }
    }
}