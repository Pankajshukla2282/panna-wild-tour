class Resort extends PostType
{
    protected string $postType='pwt_resort';

    protected string $singular='Resort';

    protected string $plural='Resorts';

    protected function menuIcon(): string
    {
        return 'dashicons-building';
    }
}