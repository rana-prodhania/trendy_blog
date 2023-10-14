<?php
class MessageHandler
{
    private $messages = [];

    public function addErrMsg($message)
    {
        $this->messages[] = ['type' => 'error', 'text' => $message];
        echo '<script>toastr.error("' . $message . '")</script>';
    }

    public function addSucMsg($message)
    {
        $this->messages[] = ['type' => 'success', 'text' => $message];
        echo '<script>toastr.success("' . $message . '")</script>';
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
