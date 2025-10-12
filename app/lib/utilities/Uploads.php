<?php 
namespace App\Lib\Utilities;

class Uploads {

    private $_errors = [], $_files=[], $_maxAllowedSize = 5242880; // Ограничение размера в 5 мб
    private $_allowedImageTypes = [IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG]; // Разрешенные форматы изображений

    public function __construct($files){
      // Преобразуем структуру файлов в более удобную
      $this->_files = self::restructureFiles($files);
    }

    public function runValidation(){
      // Проверяем размер файлов и тип
      $this->validateSize();
      $this->validateImageType();
    }

    public function validates(){
      // Возвращаем true, если ошибок нет, иначе массив с ошибками
      return (empty($this->_errors))? true : $this->_errors;
    }

    public function upload($bucket, $name, $tmp){
      // Логируем информацию о загрузке
        error_log('Uploads::upload');
        error_log('bucket: ' . $bucket);
        error_log('name: ' . $name);
        error_log('tmp: ' . $tmp);
        error_log('abs path: ' . (ROOT.DS.$bucket.$name));
        // Создаем директорию, если она не существует
        if (!file_exists($bucket)) {
            error_log('mkdir: ' . $bucket);
            mkdir($bucket);
        }
        // Перемещаем файл в целевую директорию
        $resp = move_uploaded_file($tmp, ROOT.DS.$bucket.$name);
        error_log('move_uploaded_file result: ' . var_export($resp, true));
        return $resp;
    }

    public function getFiles(){
      // Возвращаем файлы, полученные из конструктора
      return $this->_files;
    }

    protected function validateImageType(){
      foreach($this->_files as $file){
        // Пропускаем пустые
        if (empty($file['tmp_name'])) {
          continue;
        }
        // Проверяем тип файла
        if(!in_array(exif_imagetype($file['tmp_name']),$this->_allowedImageTypes)){
          // Если тип файла не поддерживается, добавляем ошибку
          $name = $file['name'];
          $msg = $name . " Неверный тип файла. Используйте формат jpeg, gif, или png.";
          $this->addErrorMessage('',$msg);
        }
      }
    }

    protected function validateSize(){
      foreach($this->_files as $file){
        $name = $file['name'];
        // Проверяем размер файла
        if($file['size'] > $this->_maxAllowedSize){
          // Если размер файла превышает максимальный - добавляем ошибку
          $msg = "Максимальный размер файла - 5 Мб.";
          $this->addErrorMessage('', $msg);
        }
      }
    }

    protected function addErrorMessage($name,$message){
      if(array_key_exists($name,$this->_errors)){
        // Если ошибка есть, добавляем к ней новое сообщение
        $this->_errors[$name] .= $this->_errors[$name] . " " . $message;
      } else {
        // Если ошибки нет, создаем новую
        $this->_errors[$name] = $message;
      }
    }

    public static function restructureFiles($files){
      $structured = [];
      foreach($files['tmp_name'] as $key => $val){
        // Создаем удобную структуру файлов
        $structured[] = [
          'tmp_name'=>$files['tmp_name'][$key],'name'=>$files['name'][$key],
          'size'=>$files['size'][$key],'error'=>$files['error'][$key],'type'=>$files['type'][$key]
        ];
      }
      return $structured;
    }
}
?>