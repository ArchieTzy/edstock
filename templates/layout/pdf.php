<?php
$this->response->setTypeMap('pdf',['application/pdf']);
$this->response = $this->response->withType('pdf');
echo $this->fetch('content');