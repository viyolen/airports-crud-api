Kurulum için

Sırasıyla şu komutları çalıştırın;


docker-compose up -d
./vendor/bin/sail artisan migrate             
./vendor/bin/sail artisan db:seed  
./vendor/bin/sail artisan scout:sync-index-settings
