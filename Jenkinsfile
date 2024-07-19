pipeline {
    agent any
    stages {
        stage('verify installations') {
            steps {
                bat '''
                    php -v
                    vendor\\bin\\phpunit --version
                '''
            }
        }
        stage('run tests') {
            steps {
                bat 'vendor\\bin\\phpunit --bootstrap vendor/autoload.php tests'
            }
        }
        stage('run tests with TestDox') {
            steps {
                bat 'vendor\\bin\\phpunit --bootstrap vendor/autoload.php --testdox tests'
            }
        }
        stage('run tests with JUnit results') {
            steps {
                bat 'vendor\\bin\\phpunit --bootstrap vendor/autoload.php --log-junit test-results\\phpunit.xml tests'
            }
            post {
                always {
                    junit testResults: 'test-results\\*.xml', skipPublishingChecks: true
                }
            }
        }
    }
}