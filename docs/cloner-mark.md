All dependencies installed and verified. The skill is fully operational. Here's what was created:

/website-cloner skill is ready
------------------------------

**Invoke it with:** /website-cloner https://example.com

### What was built

**Skill definition** — [.claude/commands/website-cloner.md](vscode-webview://0lc2ibr1po4o3b38de62k8srvi7ml7er80998e6gr0ogqq241vqh/index.html?id=7a1f183b-0e17-4213-a684-491e7051d8a4&parentId=1&origin=a665bca5-e765-46e6-a105-b8c85f2f9bc6&swVersion=5&extensionId=Anthropic.claude-code&platform=electron&vscode-resource-base-authority=vscode-resource.vscode-cdn.net&parentOrigin=vscode-file://vscode-app&purpose=webviewView&session=69aa5deb-e2fe-4545-ba43-8576085c82ca)The orchestration prompt with 7 phases, a strict QC agent checklist, and iteration logic up to 10 rounds.

**Tool scripts** — \[.claude/skills/website-cloner/tools/\](C:\\Users\\Administrator.claude\\skills\\website-cloner\\tools)

FileRole[asset\_downloader.py](vscode-webview://0lc2ibr1po4o3b38de62k8srvi7ml7er80998e6gr0ogqq241vqh/index.html?id=7a1f183b-0e17-4213-a684-491e7051d8a4&parentId=1&origin=a665bca5-e765-46e6-a105-b8c85f2f9bc6&swVersion=5&extensionId=Anthropic.claude-code&platform=electron&vscode-resource-base-authority=vscode-resource.vscode-cdn.net&parentOrigin=vscode-file://vscode-app&purpose=webviewView&session=69aa5deb-e2fe-4545-ba43-8576085c82ca)Downloads all images, fonts, CSS, JS from the reference site — follows CSS url() references too[local\_server.py](vscode-webview://0lc2ibr1po4o3b38de62k8srvi7ml7er80998e6gr0ogqq241vqh/index.html?id=7a1f183b-0e17-4213-a684-491e7051d8a4&parentId=1&origin=a665bca5-e765-46e6-a105-b8c85f2f9bc6&swVersion=5&extensionId=Anthropic.claude-code&platform=electron&vscode-resource-base-authority=vscode-resource.vscode-cdn.net&parentOrigin=vscode-file://vscode-app&purpose=webviewView&session=69aa5deb-e2fe-4545-ba43-8576085c82ca)Serves the cloned HTML on localhost so Chrome DevTools can screenshot it[screenshot\_compare.py](vscode-webview://0lc2ibr1po4o3b38de62k8srvi7ml7er80998e6gr0ogqq241vqh/index.html?id=7a1f183b-0e17-4213-a684-491e7051d8a4&parentId=1&origin=a665bca5-e765-46e6-a105-b8c85f2f9bc6&swVersion=5&extensionId=Anthropic.claude-code&platform=electron&vscode-resource-base-authority=vscode-resource.vscode-cdn.net&parentOrigin=vscode-file://vscode-app&purpose=webviewView&session=69aa5deb-e2fe-4545-ba43-8576085c82ca)SSIM + pixel MSE weighted comparison (SSIM 65%, pixel 35%) — outputs similarity % and hotspot grid[qc\_report.py](vscode-webview://0lc2ibr1po4o3b38de62k8srvi7ml7er80998e6gr0ogqq241vqh/index.html?id=7a1f183b-0e17-4213-a684-491e7051d8a4&parentId=1&origin=a665bca5-e765-46e6-a105-b8c85f2f9bc6&swVersion=5&extensionId=Anthropic.claude-code&platform=electron&vscode-resource-base-authority=vscode-resource.vscode-cdn.net&parentOrigin=vscode-file://vscode-app&purpose=webviewView&session=69aa5deb-e2fe-4545-ba43-8576085c82ca)Generates red heatmap diff, diff overlay, side-by-side comparison image, and a JSON QC report with per-region severity

### How the QC agent works

The skill has a **strict built-in QC agent** that scores 5 weighted categories every iteration:

*   **Layout** (30%) — header, nav, columns, footer proportions
    
*   **Visual Design** (30%) — exact colors, shadows, gradients, border-radius
    
*   **Typography** (20%) — font families, sizes, weights
    
*   **Assets/Content** (10%) — images, icons, logo
    
*   **Spacing** (10%) — padding, margins, gaps
    

If the combined score is below **95%**, QC **rejects** the clone, lists the top 5 issues with specific CSS fixes, and forces another iteration. It repeats up to 10 times.