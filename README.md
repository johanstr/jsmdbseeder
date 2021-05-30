# JSM Database Seeder
  
Een klein en simpel tooltje voor de vanilla php lessen aan eerste jaars studenten, bedoeld om een database simpel te kunnen vullen met testgegevens.  
  
  
# Hoe te installeren?  
  
###  Stap 1
```bash
    git clone https://github.com/johanstr/jsmdbseeder.git jsmdbseeder
```

### Stap 2
```bash
    cd jsmdbseeder 
    composer install
```

# Hoe te gebruiken?  
  
## CONFIG: database.php
In de map **config** vind je een bestand ***database.php***. Hierin beschrijf je voor elke tabel hoeveel records je wil genereren en hoe de inhoud van ieder kolom moet worden gegenereerd.  
  
### Voorbeeld database.php
```php
    'users:10' => [                         // Tabel: users en we willen er 10
        'name' => 'faker:name',             // Maak gebruik van Faker->name
        'email' => 'faker:freeEmail',       // Maak gebruik van Faker->freeEmail
        'password' => 'password:welkom',    // password_hash('...', default)
        'is_admin' => 'number:0',           // Numerieke waarde
        'created_at' => 'date:timestamp',   // Carbon::now()->toDateTimeString()
        'updated_at' => 'date:timestamp'    // Carbon::now()->toDateTimeString()
    ],
    'threads:20' => [                       // Tabel: threads en we willen er 20
        'title' => 'faker:sentence:5',      // Faker zin met 5 woorden
        'description' => 'faker:paragraph:4',
        'user_id' => 'rand:1:10',           // Random nummer van 1 t/m 10
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp'
    ],
```
  
Voor het genereren van data kan gebruik gemaakt worden van Faker.  
  
  
## CONFIG: dbconnection.php
Verder vind je daar ook het bestand ***dbconnection.php*** waarin je de connectiegegevens met de database vermeldt.  
  
### Voorbeeld dbconnection.php
```php
return [
    'host' => '127.0.0.1',
    'dbname' => 'dbseedertest',
    'username' => 'root',
    'password' => 'root'
];
```  
  
# Wijzigingen

## Commandline tool
Er zijn nu twee PHP-scripts te gebruiken, nl:  
1. index.php  
    Levert HTML output op
2. jsmdbseeder.php  
    Dit is de commandline versie van de tool. Deze start je in de terminal op de volgende manier:  
```bash
    php jsmdbseeder.php
```

## Nieuwe functionaliteit
Nieuwe functionaliteit toegevoegd:  
1. 'faker:randomChars:length:modifier'  
    Hier staat de modifier voor uppercase of lowercase  
    Voorbeeld: 'faker:randomChars:3:uppercase' voor een docenten afkorting
2. 'faker:gender:length:modifier'  
    Modifier staat voor uppercase of lowercase. Maar wanneer length gelijk aan 3 is werkt de modifier niet en krijg je Male of Female.

