<?php
class Blog
{
    private array $observers = [];
    private $categories;
    public function subscribe(Observer $observer)
    {
        $this->observers[] = $observer;
    }
    public function unsubscribe(Observer $observer)
    {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            $ubsubscriber = $this->observers[$key]->getName();
            echo "Unsubscribe $ubsubscriber \n";
            unset($this->observers[$key]);
        }
    }
    public function publishArticle($articleTitle, $categories)
    {
        $this->categories = $categories;
        $this->notifyObservers($articleTitle, $categories);
        echo "Article publié : $articleTitle\n";
    }
    public function notifyObservers($articleTitle, $categories)
    {
        foreach ($this->observers as $observer) {
            foreach ($categories as $category) {
                if (in_array($category, $observer->getCategories())) {
                    $observer->update($articleTitle, $category);
                }
            }
        }
    }
}

Interface Observer
{
    public function update($articleTitle, $categories);
}
class Subscriber implements Observer
{
    private $name;
    private $categories;
    public function getName()
    {
        return $this->name;
    }
    public function __construct($name, $categories)
    {
        $this->name = $name;
        $this->categories = $categories;
    }
    public function getCategories()
    {
        return $this->categories;
    }

    public function update($articleTitle, $categories)
    {
        echo "$this->name a été notifié du nouvel article : $articleTitle\n categories : $categories \n";
    }
}
$blog = new Blog();
$subscriber1 = new Subscriber("John", ['PHP']);
$subscriber2 = new Subscriber("Mary", ['Java']);
$blog->subscribe($subscriber1);
$blog->subscribe($subscriber2);
$blog->publishArticle("Hello World", ['PHP', 'Java']);
$blog->publishArticle("Hello Wold new article", ['Java']);
$blog->unsubscribe($subscriber2);
$blog->publishArticle("Hello Wold new article test", ['Java']);
