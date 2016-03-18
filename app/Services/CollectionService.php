<?php namespace App\Services;

class CollectionService
{

	$collectionRepository;
	$audiobookRepostiroy;

	public function __construct(CollectionRepository $collectionRepository, AudioBookRepository $audiobookRepostiroy)
	{
    	$this->collectionRepository = $collectionRepository;
    	$this->audiobookRepostiroy = $audiobookRepostiroy;
	}

	public function create(array $input)
	{
		
	}

}