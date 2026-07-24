class Gallery extends PostType
{
    protected string $postType='pwt_gallery';

    protected string $singular='Gallery';

    protected string $plural='Galleries';

    protected function menuIcon(): string
    {
        return 'dashicons-format-gallery';
    }
}