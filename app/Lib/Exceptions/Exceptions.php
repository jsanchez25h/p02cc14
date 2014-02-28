<?

class InternalException extends CakeException {
	protected $_messageTemplate = '%s';
	public $show_to_public = true;
}


class PublicException extends CakeException {
    protected $_messageTemplate = '%s';
    public $show_to_public = false;
}

