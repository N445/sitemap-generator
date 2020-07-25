<?php

namespace App\Command;

use App\Service\Sitemap\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class SitemapGenerateCommand extends Command
{
    protected static $defaultName = 'sitemap:generate';
    /**
     * @var Generator
     */
    private $generator;
    
    /**
     * SitemapGenerateCommand constructor.
     * @param string|null $name
     * @param Generator $generator
     */
    public function __construct(string $name = null, Generator $generator)
    {
        parent::__construct($name);
        $this->generator = $generator;
    }
    
    protected function configure()
    {
        $this->setDescription('Add a short description for your command');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);
        
//        $question = new Question('Entrez l\'url du site : ', 'https://ozanges.fr');
//
//        $baseurl = $helper->ask($input, $output, $question);
        $baseurl = 'https://ozanges.fr';
        
        dump($baseurl);
    
        $this->generator->generate($baseurl);
        
        $io->success('Sitemap généré avec succés.');
        
        return 0;
    }
}
