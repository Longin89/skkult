<?php

namespace Core;

use Core\Session;

class FH
{
    public static function inputBlock($type, $label, $name, $value = '', $inputAttrs = [], $divAttrs = []) //  Генерирует блок ввода с подписью.
    {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<label class="block__label" for="' . $name . '">' . $label . '</label>';
        $html .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" value="' . $value . '"' . $inputString . ' />';
        $html .= '</div>';
        return $html;
    }

    public static function inputTextarea($label, $name, $value, $inputAttrs = [], $divAttrs = [])
    {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);

        $html = '<div' . $divString . '>';
        $html .= '<label  class="block__label" for="' . $name . '" class="m-1">' . $label . '</label>';
        $html .= '<textarea id="' . $name . '" name="' . $name . '"' . $inputString . '>' . htmlspecialchars($value) . '</textarea>';
        $html .= '</div>';

        return $html;
    }

    public static function submitTag($buttonText, $inputAttrs = []) // Создает тег отправки формы.
    {
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<input type="submit" value="' . $buttonText . '"' . $inputString . ' />';
        return $html;
    }

    public static function submitBlock($buttonText, $inputAttrs = [], $divAttrs = []) // Генерирует блок кнопки отправки формы.
    {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<input type="submit" value="' . $buttonText . '"' . $inputString . ' />';
        $html .= '</div>';
        return $html;
    }

    public static function checkboxBlock($label, $name, $checked = false, $inputAttrs = [], $divAttrs = []) // Создает блок чекбокс с подписью.
    {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $checkString = ($checked) ? 'checked = "checked"' : '';
        $html = '<div' . $divString . '>';
        $html .= '<label for="' . $name . '">' . $label . '<input type="checkbox" id="' . $name . '" name="' . $name . '" value="on"' . $checkString . $inputString . '></label>';
        $html .= '</div>';
        return $html;
    }

    public static function stringifyAttrs($attrs) // Преобразует атрибуты в строку.
    {
        $string = '';
        foreach ($attrs as $key => $value) {
            $string .= ' ' . $key . '="' . $value . '"';
        }
        return $string;
    }

    public static function generateToken() // Генерирует CSRF-токен и устанавливает его в сессию.
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token', $token);
        return $token;
    }

    public static function checkToken($token) // Проверяет соответствие переданного токена установленному в сессии.
    {
        return (Session::exists('csrf_token') && Session::get('csrf_token')) == $token;
    }

    public static function csrfInput() // Генерирует скрытый input для CSRF-токена.
    {
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="' . self::generateToken() . '" />';
    }

    public static function sanitize($dirty) // Преобразует HTML-символы в безопасные экранированные символы.
    {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    public static function posted_values($post) // Очищает и санизирует значения POST-запроса.
    {
        $clean_arr = [];
        foreach ($post as $key => $val) {
            $clean_arr[$key] = self::sanitize($val);
        }
        return $clean_arr;
    }

    public static function displayErrors($errors) // Генерирует HTML для отображения ошибок валидации форм.
    {
        $hasErrors = (!empty($errors)) ? ' has-errors' : '';
        $html = '<div class="register__form-error login__form-error"><ul class="register__error-list login__error-list post__error-list' . $hasErrors . '">';
        foreach ($errors as $field => $error) {
            $html .= '<li class="register__error-item login__form-error">' . $error . '</li>';
        }
        $html .= '</ul></div>';
        return $html;
    }

    public static function errorMsg($errors, $name)
    {
        $msg = (array_key_exists($name, $errors)) ? $errors[$name] : "";
        return $msg;
    }

    /**
     * Creates a hidden input field
     * @method hiddenInput
     * @param  string      $name  name and id of the hidden input
     * @param  string      $value input value
     * @return string             Returns an html string for hidden input field
     */
    public static function hiddenInput($name, $value)
    {
        $html = '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />';
        return $html;
    }
}
