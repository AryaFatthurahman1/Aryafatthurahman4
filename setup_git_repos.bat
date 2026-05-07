@echo off
echo Setting up Git repositories for all projects...

cd "DarkUniverse"
git init
git add .
git commit -m "Initial commit: DarkUniverse project"
git remote add origin https://github.com/AryaFatthurahman1/DarkUniverse.git
echo DarkUniverse repository setup complete

cd "../Facetology"
git init
git add .
git commit -m "Initial commit: Facetology Studio project"
git remote add origin https://github.com/AryaFatthurahman1/Facetology.git
echo Facetology repository setup complete

cd "../ProjectHotel_Luxury"
git init
git add .
git commit -m "Initial commit: Project Hotel Luxury"
git remote add origin https://github.com/AryaFatthurahman1/ProjectHotel_Luxury.git
echo ProjectHotel_Luxury repository setup complete

cd "../Toko_Barang1"
git init
git add .
git commit -m "Initial commit: Toko Barang1 retail management"
git remote add origin https://github.com/AryaFatthurahman1/Toko_Barang1.git
echo Toko_Barang1 repository setup complete

cd "../WebsiteBaru"
git init
git add .
git commit -m "Initial commit: WebsiteBaru framework testing"
git remote add origin https://github.com/AryaFatthurahman1/WebsiteBaru.git
echo WebsiteBaru repository setup complete

cd "../Mobile Computing Flutter"
git init
git add .
git commit -m "Initial commit: Mobile Computing Flutter project"
git remote add origin https://github.com/AryaFatthurahman1/mobile-computing-flutter.git
echo Mobile Computing Flutter repository setup complete

cd "../osave-laravel"
git init
git add .
git commit -m "Initial commit: O! Save Laravel project"
git remote add origin https://github.com/AryaFatthurahman1/osave-laravel.git
echo osave-laravel repository setup complete

cd "../osave-db-project"
git init
git add .
git commit -m "Initial commit: O! Save Database project"
git remote add origin https://github.com/AryaFatthurahman1/osave-db-project.git
echo osave-db-project repository setup complete

cd "../QuantumPennyLane"
git init
git add .
git commit -m "Initial commit: Quantum PennyLane project"
git remote add origin https://github.com/AryaFatthurahman1/QuantumPennyLane.git
echo QuantumPennyLane repository setup complete

cd "../antigravity-hub"
git init
git add .
git commit -m "Initial commit: AntiGravity Hub"
git remote add origin https://github.com/AryaFatthurahman1/antigravity-hub.git
echo antigravity-hub repository setup complete

cd "../antigravity-superhub"
git init
git add .
git commit -m "Initial commit: AntiGravity SuperHub"
git remote add origin https://github.com/AryaFatthurahman1/antigravity-superhub.git
echo antigravity-superhub repository setup complete

echo All repositories have been initialized!
echo Next steps:
echo 1. Create these repositories on GitHub at https://github.com/AryaFatthurahman1
echo 2. Use the following commands to push:
echo    git push -u origin main
pause
