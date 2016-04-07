<?php
define('GENDER_MALE', 'male');
define('GENDER_FEMALE', 'female');

// Классификация машин
define('CAR_CLASS_SEDAN', 'sedan');

// --------------------------------------
// Список гендерной принадлежности
$genders = [
    GENDER_MALE,
    GENDER_FEMALE
];

// Список классов машин
$classes_cars = [
    CAR_CLASS_SEDAN,
];

// Страны
$countries = [
    [
        // ID страны
        'id' => 1,
        'name' => 'Italia'
    ],
    [
        'id' => 2,
        'name' => 'USA'
    ],
    [
        'id' => 3,
        'name' => 'Michigan'
    ]
];

// Массив городов
$cities = [
    [
        // ID города
        'id' => 1,
        'name' => 'Milano',
        // ID Страны
        'country_id' => 1
    ],
    [
        'id' => 2,
        'name' => 'Flat Rock',
        'country_id' => 3
    ]
];

// Пользователи
$users = [
    [
        // ID пользователя
        'id' => 1,
        'first_name' => 'Валентин',
        'last_name' => 'Радужный',
        'second_name' => 'Игоревич',
        'login' => 'valentin',
        'password' => '78vrE0871',
        'gender' => GENDER_MALE,
        'addition_info' => null,
        'birthday' => '14.05.1990',
    ],
    [
        'id' => 2,
        'first_name' => 'Олег',
        'last_name' => 'Мозговой',
        'second_name' => 'Дмитриевич',
        'login' => 'oleg',
        'password' => 'A87s08w7',
        'gender' => GENDER_MALE,
        'addition_info' => 'Машины - моя стихия',
        'birthday' => '10.07.1991',
    ],
    [
        'id' => 3,
        'first_name' => 'Виктория',
        'last_name' => 'Рыбкина',
        'second_name' => 'Александровна',
        'login' => 'prosto_vika',
        'password' => '9Wd803d',
        'gender' => GENDER_FEMALE,
        'addition_info' => 'Я феминистка',
        'birthday' => '23.07.1989',
    ],
];

// Машины
$cars = [
    [
        // ID машины
        'id' => 1,
        'name' => 'Alfa Romeo MiTo',
        'company' => 'Alfa Romeo',
        'city_id' => 1,
        'class' => CAR_CLASS_SEDAN,
    ],
    [
        'id' => 2,
        'name' => 'Ford Mustang',
        'company' => 'Ford',
        'city_id' => 2,
        'class' => CAR_CLASS_SEDAN,
    ],
];

// Принадлежание машин пользователям
$users_cars = [
    [
        // ID записи: <пользователь-машина>
        'id' => 1,
        'user_id' => 2,
        'car_id' => 1
    ],
    [
        'id' => 2,
        'user_id' => 3,
        'car_id' => 1
    ],
    [
        'id' => 3,
        'user_id' => 3,
        'car_id' => 2
    ],
    // И да, у феминистки 2 машины - это не ошибка
];

function get_country($id)
{
    global $countries;

    for ($i = 0; $i < count($countries); $i++) {
        if ($countries[$i]['id'] == $id) {
            return $countries[$i];
        }
    }
}

function get_country_city($id)
{

    global $cities;
    global $countries;

    $country_id = null;

    for ($i = 0; $i < count($cities); $i++) {
        if ($cities[$i]['id'] == $id) {
            $country_id = $cities[$i]['country_id'];
            break;
        }
    }

    if ($country_id == null) {
        return null;
    }

    for ($i = 0; $i < count($countries); $i++) {
        if ($countries[$i]['id'] == $country_id) {
            return $countries[$i];
        }
    }
}

function get_cities_country($id)
{
    global $cities;

    $result = [];

    for ($i = 0; $i < count($cities); $i++) {
        if ($cities[$i]['country_id'] == $id) {
            $result = $cities[$i];
        }
    }

    return $result;
}

function get_city($id)
{
    global $cities;

    for ($i = 0; $i < count($cities); $i++) {
        if ($cities[$i]['id'] == $id) {
            return $cities[$i];
        }
    }
}

function get_user($id)
{
    global $users;

    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]['id'] == $id) {
            return $users[$i];
        }
    }
    return "Пользователь по id $id не найден";
}

function create_user_full_name($first_name, $last_name, $second_name)
{
    return $last_name . ' ' . $first_name . ' ' . $second_name;
}

function get_user_full_name($id)
{
    global $users;

    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]['id'] == $id) {


            $last_name = $users[$i]['last_name'];
            $first_name = $users[$i]['first_name'];
            $second_name = $users[$i]['second_name'];

           return  create_user_full_name($first_name, $last_name, $second_name);
        }
    }
}

function get_car($id)
{
    global $cars;

    for ($i = 0; $i < count($cars); $i++) {
        if ($cars[$i]['id'] == $id) {
            return $cars[$i];
        }
    }
}

function get_users($ids)
{
    global $users;

    $result = [];

    for ($i = 0; $i < count($ids); $i++) {
        for ($j = 0; $j < count($users); $j++) {
            if ($users[$j]['id'] == $ids[$i]) {
                $result[] = $users[$j];
            }
        }
    }
    return $result;
}

function change_user_password($user_id, $old_password, $new_password)
{
    global $users;

    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]['id'] == $user_id) {
            if ($users[$i]['password'] == $old_password) {
                $users[$i]['password'] = $new_password;
                return true;
            }
        }
    }

    return false;
}

function get_cars_user($id)
{
    global $users_cars;
    global $cars;

    $cars_id = [];
    $result = null;

    for ($i = 0; $i < count($users_cars); $i++) {
        if ($users_cars[$i]['user_id'] == $id) {
            $cars_id[] = $users_cars[$i]['car_id'];
        }
    }


    for ($i = 0; $i < count($cars); $i++) {
        for ($j = 0; $j < count($cars_id); $j++) {
            if ($cars[$i]['id'] == $cars_id[$j]) {
                $result[] = $cars[$i];
            }
        }
    }

    return $result;
}

function get_users_car($car_id)
{
    global $users_cars;
    global $users;

    $users_id = [];
    $result = null;

    for ($i = 0; $i < count($users_cars); $i++) {
        if ($users_cars[$i]['car_id'] == $car_id) {
            $users_id[] = $users_cars[$i]['user_id'];
        }
    }

    for ($i = 0; $i < count($users); $i++) {
        for ($j = 0; $j < count($users_id); $j++) {
            if ($users[$i]['id'] == $users_id[$j]) {
                $result[] = $users[$i];
            }
        }
    }
    return $result;
}

function search_user($options)
{
    global $users;

}


echo "Результат функции get_country - ";
$get_country = get_country(2);
print_r($get_country);
echo "<br><br>";
echo "Результат функции get_county_city - ";
$get_country_city = get_country_city(2);
print_r($get_country_city);
echo "<br><br>";
echo "Результат функции get_cities_country - ";
$get_cities_country = get_cities_country(3);
print_r($get_cities_country);
echo "<br><br>";
echo "Результат функции get_city - ";
$get_city = get_city(2);
print_r($get_city);
echo "<br><br>";
echo "Результат функции get_user - ";
$get_user = get_user(1);
print_r($get_user);
echo "<br><br>";
echo "Результат функции create_user_full_name - ";
echo create_user_full_name("Василий", "Пупкин", "Петрович");
echo "<br><br>";
echo "Результат функции get_user_full_name - ";
echo get_user_full_name(3);
echo "<br><br>";
echo "Результат функции get_car - ";
print_r(get_car(1));

echo "<br><br>";
echo "Результат функции get_users - ";
$search_users = [2, 3];
$get_users = get_users($search_users);
echo "<pre>";
print_r($get_users);
echo "<pre>";
echo "<br><br>";
echo "Результат функции change_user_password - ";
if (change_user_password(3, '9Wd803d', '123123')) {
    echo 'true';
} else {
    echo 'Текущий пароль введен не верно!';
}
echo "<br><br>";
echo "Результат функции get_cars_user - ";
print_r(get_cars_user(3));
echo "<br><br>";
echo "Результат функции get_users_car - ";
print_r(get_users_car(1));


$keys = [
    'id' => 1,
    'first_name' => 'Вален'
];

print_r(search_user($keys));
