<?php

    $db_create = new DB_Create();
    $db_create->start();

    class DB_Create {

        private $host, $user, $password, $db_name, $tbl_name, $tbl_field, $tbl_record;

        private $targets = array('db', 'tbl', 'col');

        private $tbls = array(
            array(
                'tbl_name' => 'type',

                'tbl_field' => "
                    id INT AUTO_INCREMENT,
                    type VARCHAR(8) CHECK (type in ('FIRE', 'WATER', 'ELECTRIC', 'GRASS', 'ICE', 'FIGHTING', 'POISON', 'GROUND', 'FLYING', 'PSYCHIC', 'BUG', 'NORMAL', 'ROCK', 'GHOST', 'DRAGON', 'DARK', 'STEEL', 'FAIRY', 'NULL')),
                    img VARCHAR(255) NOT NULL DEFAULT (''),
                    created_at TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP),
                    PRIMARY KEY (id)
                ",

                'tbl_record' => "
                    (type, img)

                    VALUES

                    ('Fire', '../assets/img/types/fire.jpg'),

                    ('Water', '../assets/img/types/water.jpg'),

                    ('Electric', '../assets/img/types/electric.jpg'),

                    ('Grass', '../assets/img/types/grass.jpg'),

                    ('Ice', '../assets/img/types/ice.jpg'),

                    ('Fighting', '../assets/img/types/fighting.jpg'),
                    
                    ('Poison', '..assets/img/types/poison.jpg'),

                    ('Ground', '..assets/img/types/ground.jpg'),

                    ('Flying', '..assets/img/types/flying.jpg'),

                    ('Psychic', '../assets/img/types/psychic.jpg'),

                    ('Bug', '../assets/img/types/bug.jpg'),

                    ('Normal', '../assets/img/types/normal.jpg'),

                    ('Rock', '../assets/img/types/rock.jpg'),

                    ('Ghost', '../assets/img/types/ghost.jpg'),

                    ('Dragon', '../assets/img/types/dragon.jpg'),

                    ('Dark', '../assets/img/types/dark.jpg'),

                    ('Steel', '../assets/img/types/steel.jpg'),

                    ('Fairy', '../assets/img/types/fairy.jpg'),
                    
                    ('Null', '')
                "
            ),
            
            array(
                'tbl_name' => 'species',

                'tbl_field' => "
                    id INT AUTO_INCREMENT,
                    species VARCHAR(255) NOT NULL UNIQUE,
                    type1_id INT NOT NULL,
                    type2_id INT NOT NULL CHECK (type2_id != type1_id),
                    created_at TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP),
                    PRIMARY KEY (id),
                    FOREIGN KEY (type1_id) REFERENCES type (id),
                    FOREIGN KEY (type2_id) REFERENCES type (id)
                ",

                'tbl_record' => "
                    (species, type1_id, type2_id)

                    VALUES

                    (
                        'Chandelure',

                        (SELECT id FROM type WHERE type = 'GHOST'),

                        (SELECT id FROM type WHERE type = 'FIRE')
                    ),

                    (
                        'Gengar',
                        
                        (SELECT id FROM type WHERE type = 'GHOST'),
                        
                        (SELECT id FROM type WHERE type = 'POISON')
                    ),

                    (
                        'Magnezone',
                        
                        (SELECT id FROM type WHERE type = 'ELECTRIC'),
                        
                        (SELECT id FROM type WHERE type = 'STEEL')
                    ),

                    (
                        'Dragonite',
                        
                        (SELECT id FROM type WHERE type = 'DRAGON'),
                        
                        (SELECT id FROM type WHERE type = 'FLYING')
                    ),

                    (
                        'Lugia',
                        
                        (SELECT id FROM type WHERE type = 'PSYCHIC'),
                        
                        (SELECT id FROM type WHERE type = 'FLYING')
                    ),

                    (
                        'Incineroar',
                        
                        (SELECT id FROM type WHERE type = 'FIRE'),
                        
                        (SELECT id FROM type WHERE type = 'DARK')
                    ),

                    (
                        'Dusknoir',
                        
                        (SELECT id FROM type WHERE type = 'GHOST'),
                        
                        (SELECT id FROM type WHERE type = 'NULL')
                    ),

                    (
                        'Prinplup',
                        
                        (SELECT id FROM type WHERE type = 'WATER'),
                        
                        (SELECT id FROM type WHERE type = 'NULL')
                    ),

                    (
                        'Koraidon',
                        
                        (SELECT id FROM type WHERE type = 'FIGHTING'),
                        
                        (SELECT id FROM type WHERE type = 'DRAGON')
                    )
                "
            ),
            
            array(
                'tbl_name' => 'pokemon',

                'tbl_field' => "
                    id INT AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    species_id INT NOT NULL,
                    description LONGTEXT NOT NULL,
                    img VARCHAR(255) NOT NULL DEFAULT (''),
                    intake_time DATETIME,
                    adoption_time DATETIME,
                    created_at TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP),
                    PRIMARY KEY (id),
                    FOREIGN KEY (species_id) REFERENCES species (id)
                ",

                'tbl_record' => "
                    (name, species_id, description, img, intake_time)

                    VALUES

                    (
                        'Amier',

                        (SELECT id FROM species WHERE species = 'Chandelure'),

                        'A gentle and emotional pokémon that enjoys floating about in broad daylight anywhere there are flowers.',

                        '../assets/img/pokemon/chandelure.jpg',

                        NOW()
                    ),
                    
                    (
                        'Leiroh',

                        (SELECT id FROM species WHERE species = 'Gengar'),

                        'A creative and shy pokémon that really enjoys some peace and quiet. When disturbed from his artist zone, he will throw a temper tantrum.',

                        '../assets/img/pokemon/gengar.jpg',
                        
                        NOW()
                    ),
                    
                    (
                        'Paliz',

                        (SELECT id FROM species WHERE species = 'Magnezone'),

                        'A cheeky and mischievous pokémon that enjoys shorting out devices but is easily distracted by her favourite food, macaron.',

                        '../assets/img/pokemon/magnezone.jpg',
                        
                        NOW()
                    ),
                    
                    (
                        'Dergz',

                        (SELECT id FROM species WHERE species = 'Dragonite'),

                        'A Dragonite that will hug everything and show his unending affection and love to anything and everything. He does not easily forgive anyone who hurts him or the people and pokémon he cares about. He will not hesitate to protect whatever the cost might be.',

                        '../assets/img/pokemon/dragonite.jpg',
                        
                        NOW()
                    ),
                    
                    (
                        'Teraille',

                        (SELECT id FROM species WHERE species = 'Lugia'),

                        'A Lugia with dwarfism and is very proud of it. He flies about quickly and freely, enjoying how more agile he is due to being smaller and how he can go to places where normal Lugias can’t usually go.',

                        '../assets/img/pokemon/lugia.jpg',
                        
                        NOW()
                    ),
                    
                    (
                        'Ohnerion',

                        (SELECT id FROM species WHERE species = 'Incineroar'),

                        'A fiesty and stubborn pokémon, it will take a lot before he start to trust another. But once earning his trust, you might be smothering by tons of affectionate play that might end up with you being scorched or pumelled around with love.',

                        '../assets/img/pokemon/incineroar.jpg',
                        
                        NOW()
                    )
                "
            ),
            
            array(
                'tbl_name' => 'role',

                'tbl_field' => "
                    id INT AUTO_INCREMENT,
                    role VARCHAR(255) NOT NULL UNIQUE,
                    created_at TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP),
                    PRIMARY KEY (id)
                ",

                'tbl_record' => "
                    (role) VALUES ('admin'), ('staff'), ('user')
                "
            ),
            
            array(
                'tbl_name' => 'account',

                'tbl_field' => "
                    id INT AUTO_INCREMENT,
                    role_id INT NOT NULL DEFAULT (3),
                    email VARCHAR(255) NOT NULL UNIQUE CHECK (email REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,6}$'),
                    password VARCHAR(255) NOT NULL,
                    pfp_url VARCHAR(255),
                    username VARCHAR(255) NOT NULL UNIQUE,
                    gender VARCHAR(10) NOT NULL CHECK (gender in ('Male', 'Female', 'Non-Binary')),
                    bday DATE NOT NULL,
                    mobile VARCHAR(12) NOT NULL UNIQUE CHECK (mobile REGEXP '^639[0-9]{9}$'),
                    typePreference VARCHAR(255),
                    regionPreference VARCHAR(255),
                    created_at TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP),
                    PRIMARY KEY (id),
                    FOREIGN KEY (role_id) REFERENCES role (id)
                ",

                'tbl_record' => "
                    (role_id, email, password, pfp_url, username, gender, bday, mobile, typePreference, regionPreference)
                    VALUES
                    ((SELECT id FROM role WHERE role = 'admin'), 'ashie.loche@pokedopt.com', ':password1', '../assets/pfp/ashie_loche.png','Ashie_Loche', 'Male', '2002/12/09','639165733654', 'Ghost', 'Kalos'),
                    ((SELECT id FROM role WHERE role = 'user'), 'ashton.loche@gmail.com', ':password2', '../assets/pfp/ashton_loche.jpg', 'Ashton_Loche', 'Non-Binary', '2002/12/09', '639610734066', 'Fire/Electric', '')
                "
            ),

            array(
                'tbl_name' => 'likes',

                'tbl_field' => "
                    id INT AUTO_INCREMENT,
                    pokemon_id int NOT NULL,
                    user_id int NOT NULL,
                    PRIMARY KEY (id),
                    FOREIGN KEY (pokemon_id) REFERENCES pokemon (id),
                    FOREIGN KEY (user_id) REFERENCES account (id)
                ",

                'tbl_record' => "
                "
            )
        );

        public function __construct() {
            $this->host = 'localhost';
            $this->user = 'root';
            $this->password = '';
            $this->db_name = 'pokedopt';
        }

        public function start() {
            foreach ($this->targets as $target) {

                if ($target == 'tbl') {
                    foreach ($this->tbls as $tbl) {
                        $this->tbl_name = $tbl['tbl_name'];
                        $this->tbl_field = $tbl['tbl_field'];
                        $this->check($target);
                    }
                } else if ($target == 'col') {
                    foreach ($this->tbls as $tbl) {
                        if ($tbl['tbl_name'] != 'likes') {
                            $this->tbl_name = $tbl['tbl_name'];
                            $this->tbl_record = $tbl['tbl_record'];
                            $this->check($target);
                        }
                    }
                } else {
                    $this->check($target);
                }

            }
        }

        private function check($target) {
            
            $conn = mysqli_connect($this->host, $this->user, $this->password, ($target == 'db') ? 'mysql' : $this->db_name);

            if ($target == 'db') {
                $query = "SHOW DATABASES LIKE '$this->db_name'";
            } else if ($target == 'tbl') {
                $query = "SHOW TABLES FROM $this->db_name WHERE Tables_in_$this->db_name = '$this->tbl_name'";
            } else if ($target == 'col') {
                $query = "SELECT * FROM $this->tbl_name";
            }

            if (!$conn) {
                die('Connection Failed: ' . $conn->connect_error . '<br>');
            } else  {
                if (!mysqli_query($conn, $query)) {
                    die('Query Error: ' . mysqli_error($conn) . '<br>');
                } else {

                    // Get Results
                    $result = mysqli_query($conn, $query);
    
                    // Fetch Results to a Dictionary
                    $fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
                    // Free Results
                    mysqli_free_result($result);
                    
                    if (empty($fetched)) {
                        $this->create($target);
                    }

                }
            }

            // Close Connection
            mysqli_close($conn);

        }

        private function create($target) {
            
            $conn = mysqli_connect($this->host, $this->user, $this->password, ($target == 'db') ? 'mysql' : $this->db_name);
            
            $query = "CREATE ";

            if ($target == 'db') {
                $query .= "DATABASE IF NOT EXISTS $this->db_name";
            } else if ($target == 'tbl') {
                $query .= "TABLE IF NOT EXISTS $this->tbl_name ($this->tbl_field)";
            } else if ($target == 'col') {
                $query = "INSERT INTO $this->tbl_name $this->tbl_record";

                if ($this->tbl_name == 'account') {
                    $query = str_replace(':password1', password_hash('ThisIsMyPokedoptYIPPIE!!!<3', PASSWORD_DEFAULT), $query);
                    $query = str_replace(':password2', password_hash('PokedoptYIPPIE!!!<3', PASSWORD_DEFAULT), $query);
                }
                
            }

            if (!$conn) {
                die('Connection Failed: ' . $conn->connect_error . '<br>');
            } else  {
                if (!mysqli_query($conn, $query)) {
                    die('Query Error: ' . mysqli_error($conn) . '<br>');
                }
            }

            // Close Connection
            mysqli_close($conn);

        }

    }

?>