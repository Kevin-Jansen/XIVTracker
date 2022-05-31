<?php

namespace App\Command;

use App\Entity\Achievement;
use App\Repository\AchievementRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[AsCommand(
    name: 'data-parser',
    description: 'Add a short description for your command',
)]
class DataParserCommand extends Command {
    private EntityManagerInterface $em;
    private Serializer $serializer;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
        $this->serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);

        $this->parseAchievements();

        $this->em->flush();
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

    private function parseAchievements() {
        // Next, let's instantiate a new Serializer and give it a new CsvEncoder, after which we'll parse the game data
        $data = $this->serializer->decode($this->getCSVContents('Achievement.csv'), 'csv', [CsvEncoder::DELIMITER_KEY => ',']);
        $repository = $this->em->getRepository(Achievement::class);

        foreach ($data as $row) {
            if (!is_numeric($row['key']) || !$row[0]) continue;

            // We'll dynamically instantiate the class
            $identifier = array_search('Name', $data[0]);
            $obj = $repository->findOneBy(['name' => $row[$identifier]]);
            if (!$obj) $obj = new Achievement();

            // Next, let's map the indicies to the object
            foreach (Achievement::$data_mappings as $key => $value) {
                $i = array_search($key, $data[0]);
                $setter = 'set' . ucfirst($value);
                $obj->$setter($row[$i]);
            }

            $this->em->persist($obj);
        }

        $this->em->flush();
    }

    /**
     * Returns the contents of a given CSV game data file
     * @param string $dataFile
     * @return string
     */
    private function getCSVContents(string $dataFile) : string {
        $finder = new Finder();
        $finder = $finder
            ->files()
            ->name($dataFile)
            ->in('src/GameData');

        // Let's get the CSV file, this should only match to one
        $iterator = $finder->getIterator();
        $iterator->rewind();
        return $iterator->current()->getContents();
    }
}
