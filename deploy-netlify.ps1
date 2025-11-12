# Deploy TaskManager to Netlify

Write-Host "🚀 Preparing TaskManager for Netlify deployment..." -ForegroundColor Cyan

# Check if netlify CLI is installed
if (-not (Get-Command netlify -ErrorAction SilentlyContinue)) {
    Write-Host "❌ Netlify CLI not found. Installing..." -ForegroundColor Yellow
    npm install -g netlify-cli
}

# Add all files
Write-Host "📦 Adding files to git..." -ForegroundColor Cyan
git add .

# Commit changes
Write-Host "💾 Committing changes..." -ForegroundColor Cyan
git commit -m "Configure Netlify deployment"

# Push to GitHub
Write-Host "⬆️ Pushing to GitHub..." -ForegroundColor Cyan
git push origin main

Write-Host ""
Write-Host "✅ Files pushed to GitHub!" -ForegroundColor Green
Write-Host ""
Write-Host "📋 Next steps:" -ForegroundColor Yellow
Write-Host "1. Go to https://app.netlify.com" -ForegroundColor White
Write-Host "2. Click 'Add new site' → 'Import an existing project'" -ForegroundColor White
Write-Host "3. Choose GitHub and select 'task-manager' repository" -ForegroundColor White
Write-Host "4. Build command: ./netlify-build.sh" -ForegroundColor White
Write-Host "5. Publish directory: public" -ForegroundColor White
Write-Host "6. Click 'Deploy site'" -ForegroundColor White
Write-Host ""
Write-Host "⚠️ IMPORTANT: Netlify has limited PHP support." -ForegroundColor Red
Write-Host "   Consider using Vercel instead (already configured):" -ForegroundColor Red
Write-Host "   Run: vercel --prod" -ForegroundColor White
Write-Host ""
