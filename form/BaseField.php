<?php

namespace morlowsk\corephp\form;
use morlowsk\corephp\Model;

/**
 * Summary of BaseField
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
abstract class BaseField
{
    public Model $model;
    public string $attribute;
    /**
     * Summary of __construct
     * @param \morlowsk\corephp\Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }
    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf('
        <div class="form-group">
            <label>%s</label>
            %s
            <div class="invalid-feedback">
               %s
            </div>
        </div>
        ', 
        $this->model->getLabel($this->attribute) ?? $this->attribute,
        $this->renderInput(),
        $this->model->getFirstError($this->attribute));
    }
}