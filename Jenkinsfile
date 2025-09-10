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
                sh 'docker exec test_ci_cd-php-1 composer install --no-progress --prefer-dist --optimize-autoloader'
            }
        }
        
        stage('PHP Syntax Check') {
            steps {
                sh 'docker exec test_ci_cd-php-1 find src tests -name "*.php" -exec php -l {} \\;'
            }
        }
        
        stage('Run Tests') {
            steps {
                sh 'docker exec test_ci_cd-php-1 php bin/phpunit --coverage-text --coverage-clover=coverage.xml'
            }
            post {
                always {
                    // Copy coverage file from container to Jenkins workspace
                    sh 'docker cp test_ci_cd-php-1:/var/www/html/coverage.xml ./coverage.xml || true'
                    
                    // Publish test results if coverage.xml exists
                    script {
                        if (fileExists('coverage.xml')) {
                            publishTestResults testResultsPattern: 'coverage.xml'
                        }
                    }
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
