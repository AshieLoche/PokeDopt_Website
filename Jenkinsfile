pipeline {
    agent any
    stages {
        stage('Install Dependencies') {
            steps {
                powershell '''
                    # Set PowerShell execution policy
                    Set-ExecutionPolicy Bypass -Scope Process -Force

                    # Check if Chocolatey is already installed
                    if (-not (Get-Command choco -ErrorAction SilentlyContinue)) {
                        Write-Output "Chocolatey not found. Installing Chocolatey..."
                        [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.SecurityProtocolType]::Tls12
                        iex ((New-Object System.Net.WebClient).DownloadString('https://chocolatey.org/install.ps1'))

                        # Add Chocolatey to PATH
                        [System.Environment]::SetEnvironmentVariable("PATH", "$env:PATH;C:\\ProgramData\\chocolatey\\bin", [System.EnvironmentVariableTarget]::Machine)
                        Write-Output "Chocolatey installed. Please reboot the system for the changes to take effect."
                        Exit 1
                    } else {
                        Write-Output "Chocolatey is already installed."
                    }

                    # Check if PHP is already installed
                    if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
                        Write-Output "PHP not found. Installing PHP..."
                        choco install php -y
                    } else {
                        Write-Output "PHP is already installed."
                    }

                    # Ensure OpenSSL extension is enabled for PHP
                    $isOpensslLoaded = php -r "echo extension_loaded('openssl');" 2>$null
                    if ($isOpensslLoaded -eq "1") {
                        Write-Output "OpenSSL extension already loaded. Exiting."
                    } else {
                        $phpIniPath = php -r "echo php_ini_loaded_file();"
                        if (-not [string]::IsNullOrEmpty($phpIniPath)) {
                            if (Get-Content $phpIniPath | Select-String -Pattern ';extension=openssl') {
                                Write-Output "Enabling OpenSSL extension for PHP..."
                                (Get-Content $phpIniPath) -replace ';extension=openssl', 'extension=openssl' | Set-Content $phpIniPath
                                Write-Output "OpenSSL extension enabled. Please restart your web server or PHP service."
                                Exit 1
                            } else {
                                Write-Output "OpenSSL extension already enabled in the configuration file."
                            }
                        } else {
                            Write-Output "PHP INI file not found."
                        }
                    }

                    # Check if Composer is already installed
                    if (-not (Get-Command composer -ErrorAction SilentlyContinue)) {
                        Write-Output "Composer not found. Installing Composer..."
                        [Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12
                        Invoke-WebRequest -Uri https://getcomposer.org/Composer-Setup.exe -OutFile composer-setup.exe
                        Start-Process -Wait -NoNewWindow -FilePath "composer-setup.exe" -ArgumentList "/install=C:\\ProgramData\\ComposerSetup /SILENT"
                        [System.Environment]::SetEnvironmentVariable("PATH", "$env:PATH;C:\\ProgramData\\ComposerSetup\\bin", [System.EnvironmentVariableTarget]::Machine)
                        Write-Output "Composer installed."
                    } else {
                        Write-Output "Composer is already installed."
                    }

                    # Verify installations
                    Write-Output "Verifying installations..."
                    php -v
                    composer -v
                    vendor\\bin\\phpunit --version
                '''
            }
        }
        }
        stage('Run JUnit Tests') {
            steps {
                catchError(buildResult: 'UNSTABLE', stageResult: 'FAILURE') {
                    powershell '''
                        # Run PHPUnit tests with JUnit results if PHPUnit is installed
                        if (Test-Path "vendor\\bin\\phpunit") {
                            Write-Output "Running PHPUnit tests with JUnit results..."
                            & vendor\\bin\\phpunit --bootstrap vendor/autoload.php --log-junit test-results\\phpunit.xml tests
                        } else {
                            Write-Output "PHPUnit is not installed. Skipping JUnit results generation."
                        }
                    '''
                }
            }
            post {
                always {
                    junit testResults: 'test-results\\*.xml', skipPublishingChecks: true
                }
            }
        }
    }
}
