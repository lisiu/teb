### INSTALLATION
```bash
git clone project.url project
cd project
cp .env.example .env
php ./composer.phar install
php ./artisan key:generate
```

### RUN APPLICATION  
```bash
php ./artisan serve
```

### RUN TESTS  
```bash
vendor/bin/phpunit
```

### DOCUMENTATION
- API documentation: `public/api.json`

### TODO
- batch processing in queue
- describe errors in API documentation
- how to handle key duplicates (now skipped silently)
- move API endpoints to controllers (?)
- loading indicators
- form labels - i18n
- AJAX error handling
- RWD
- warning before batch generation
