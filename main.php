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
    return $countries[$id - 1]['name'];
}

function get_country_city($city_id)
{
    global $cities;
    $city = $cities[$city_id - 1]['country_id'];
    return get_country($city);
}

function get_cities_country($country_id)
{
    global $countries;
    global $cities;

    if ($country_id > count($countries) || $country_id <= 0) {
        return null;
    }

    if (isset($cities[$country_id - 1]['name'])) {
        return [$countries[$country_id - 1]['name'], $cities[$country_id - 1]['name']];
    } else return $countries[$country_id - 1]['name'];

}

function get_city($id)
{
    global $cities;

    return $cities[$id - 1]['name'];
}

function get_user($id)
{
    global $users;

    if (!isset($users[$id - 1])) {
        return 'Пользователь по такому id не найден';
    }

    return $users[$id - 1];
}

function create_user_full_name($first_name, $last_name, $second_name)
{
    $result = $first_name . ' ' . $last_name . ' ' . $second_name;

    return $result;
}

function get_user_full_name($id)
{
    global $users;
    $user = $users[$id - 1]['last_name'] . ' ' . $users[$id - 1]['first_name'] . ' ' . $users[$id - 1]['second_name'];

    return $user;
}

function get_car($id)
{
    global $cars;
    return $cars[$id - 1];
}

function get_users($ids)
{
    global $users;
    $arr = [];
    $k = 0;

    for ($i = 0; $i < count($ids); $i++) {
        if (isset($users[$ids[$i] - 1])) {
            $arr[$k++] = $users[$ids[$i] - 1];
        } else {
            return 'Пользователя с id ' . $ids[$i] . ' не существует' . '<br>';
        }
    }

    return $arr;
}

function search_user($options)
{
    global $users;

    $arr = array_keys($options);
    $result = [];
    $k = 0;

    for ($i = 0; $i < count($users); $i++) {
        if (($users[$i][$arr[0]] == $options[$arr[0]])) {
            similar_text($users[$i][$arr[1]], $options[$arr[1]], $tmp);
            if ($tmp >= 60) {
                $result[$k++] = $users[$i]['last_name'] . ' ' . $users[$i]['first_name'] . ' ' . $users[$i]['second_name'];
            }
        }
    }

    return $result;

}

function change_user_pasword($user_id, $old_password, $new_password)
{
    global $users;

    if ($users[$user_id - 1]['password'] === $old_password) {
        $users[$user_id - 1]['password'] = $new_password;
        return true;
    }
    return false;
}

function get_cars_user($user_id)
{
    global $users_cars;
    global $cars;
    $k = 0;
    $arr = [];
    $result = null;

    for ($i = 0; $i < count($users_cars); $i++) {
        foreach ($users_cars[$i] as $key => $value) {
            if ($key == 'user_id' && $value == $user_id) {
                $num = $users_cars[$i]['car_id'];
                $arr[$k++] = $cars[$num - 1]['name'];
            }
        }
    }

    for ($i = 0; $i < count($arr); $i++) {
        $result .= $arr[$i] . '  ';
    }

    return $result;

}

function get_users_car($car_id)
{
    global $users_cars;
    global $users;
    $arr = [];
    $k = 0;

    for ($i = 0; $i < count($users); $i++) {
        foreach ($users_cars[$i] as $key => $value) {
            if ($key == 'car_id' && $value == $car_id) {
                $num = $users_cars[$i]['user_id'];
                $arr[$k++] = $users[$num - 1]['last_name'] . ' ' . $users[$num - 1]['first_name'] . ' '
                    . $users[$num - 1]['second_name'];
            }
        }
    }

    return $arr;
}

echo "get_country - " . get_country(1);
echo '<br>';
echo "get_country_city - " . get_country_city(2);
$city_list = get_cities_country(1);
echo '<br>';
print_r($city_list);
echo '<br>';
echo get_city(2);
echo '<br>';
print_r(get_user(3));
echo '<br>';
echo create_user_full_name('Богдан', 'Геннадьевич', 'Носовицкий');
echo '<br>';
echo get_user_full_name(3);
echo '<br>';
print_r(get_car(1));
echo '<br>';
$user_list = [25000, 1, 3];
echo '<pre>';
print_r(get_users($user_list));
echo '<pre>';

$options = [
    'id' => '1',
    'first_name' => "Вале"
];

print_r(search_user($options));
if (change_user_pasword(1, '78vrE0871', '333')) {
    echo 'Пароль успешно изменен';
} else {
    echo 'Неверный пароль пользователя';
}


echo "<br>";
echo get_cars_user(3);
echo "<br>";
echo "<br>";
print_r(get_users_car(1));
