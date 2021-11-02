<?php


namespace App\Utils;


/**
 * Class BaseManager.
 *
 * @package App\Utils
 * @author Alejandro Pérez <alejandroprz2011@gmail.com>
 */
abstract class BaseManager
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @var
     */
    protected $error;

    /**
     * Constructor
     *
     * @param $data     Data to save
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get validation rules
     *
     * @return mixed
     */
    abstract protected function onValidate();

    /**
     * Verify if the data is valid
     *
     * @return boolean
     */
    public function validate()
    {
        $rules = $this->onValidate();
        $messages = $this->onCustomMessages();

        $validation = \Validator::make($this->data, $rules, $messages);
        $isValid = $validation->passes();

        if ($validation->fails()) {
            $this->error = $validation->errors()->all();
        }
        return $isValid;
    }

    /**
     * Get the validation errors
     *
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Get Custom Messages Validation.
     *
     * @return array
     */
    private function onCustomMessages()
    {
        return $messages = [
            'required' => 'El campo :attribute es requerido',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max' => 'El campo :attribute debe tener maximo :max caracteres.',
            'numeric' => 'El campo :attribute debe ser numerico.',
            'email'=>'El campo email no tiene los patrones requeridos',
            'unique'=>'El campo :attribute deber único'
        ];
    }
}