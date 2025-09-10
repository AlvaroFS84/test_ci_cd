pipeline {
    agent any
    
    environment {
        COMPOSER_CACHE_DIR = '/tmp/composer-cache'
    }
    
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        
        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-progress --prefer-dist --optimize-autoloader'
            }
        }
        
        stage('PHP Syntax Check') {
            steps {
                sh 'find src tests -name "*.php" -exec php -l {} \\;'
            }
        }
        
        stage('Run Tests') {
            steps {
                sh 'php bin/phpunit --coverage-text --coverage-clover=coverage.xml'
            }
            post {
                always {
                    publishTestResults testResultsPattern: 'coverage.xml'
                    publishHTML([
                        allowMissing: false,
                        alwaysLinkToLastBuild: true,
                        keepAll: true,
                        reportDir: 'coverage',
                        reportFiles: 'index.html',
                        reportName: 'Coverage Report'
                    ])
                }
            }
        }
    }
    
    post {
        always {
            cleanWs()
        }
        success {
            echo 'Pipeline succeeded!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}
