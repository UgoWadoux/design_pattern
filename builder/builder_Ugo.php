<?php
class Form{
    private $fields = [];
    public function addField($label, $type)
    {
        $this->fields[] = ['label'=>$label, 'type'=>$type];
    }
    public function getFields()
    {
        return $this->fields;
    }
    public function render(){
        $html = '<form>';
        foreach ($this->fields as $field) {
            $html .= '<label>'.$field['label'].'</label>';
            $html .= '<input type="'.$field['type'].'" placeholder="'.$field['label'].'">';
            $html .= '<br>';
        }
        $html .= '</form>';
        return $html;
    }
}

class FormBuilder{
    private $form;

    public function __construct(){
        $this->form = new Form();
    }
    public function addEmail($label)
    {
        $this->form->addField($label, 'email');
        return $this;
    }

    public function addText($label)
    {
        $this->form->addField($label, 'text');
        return $this;
    }
    public function addNumber($label)
    {
        $this->form->addField($label, 'number');
        return $this;
    }
    public function build()
    {
        return $this->form;
    }
}

$builder = new FormBuilder();
$form = $builder->addEmail('email')
                ->addText('Nom')
                ->addNumber('Nombre de personnes')
                ->build();
echo $form->render();