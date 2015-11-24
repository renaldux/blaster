<?php

namespace Blaster\CrontaskBundle\Command;

use Blaster\CrontaskBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\StringInput;

class CronTasksRunCommand extends ContainerAwareCommand
{
    private $output;

    protected function configure()
    {
        $this
            ->setName('crontasks:run')
            ->setDescription('Runs Cron Tasks if needed')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<comment>Sending newsletter...</comment>');

        $this->output = $output;
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $users = $em->getRepository('BlasterTaskBundle:Blaster')->findAll();
        $newsletterRepository = $em->getRepository('BlasterCrontaskBundle:Newsletter');

        foreach ($users as $user) {
            // Get the last run time of this task, and calculate when it should run next
            $categories = $user->getCategories();
            foreach($categories as $category){
                $newsletter = $newsletterRepository->findOneBy(array('user'=>$user, 'category'=>$category));
                if( is_null($newsletter) ){
                    $newsletter = new Newsletter();
                    $newsletter->setUser($user);
                    $newsletter->setCategory($category);
                }
                $lastrun = $newsletter->getLastRun() ? $newsletter->getLastRun()->format('U') : 0;
                $nextrun = $lastrun + 86400;
                // We must run this task if:
                // * time() is larger or equal to $nextrun
                $run = (time() >= $nextrun);

                if ($run) {
                    $output->writeln(sprintf('Sending email <info>%s</info> to <info>%s</info>', $category->getName(), $user->getName()));

                    // Set $lastrun for this crontask
                    $newsletter->setLastRun(new \DateTime());

                    try {
                        //send the newsletter

                        $output->writeln('<info>SUCCESS</info>');
                    } catch (\Exception $e) {
                        $output->writeln('<error>ERROR</error>');
                    }

                    // Persist crontask
                    $em->persist($newsletter);
                } else {
                    $output->writeln(sprintf('Skipping Cron Task <info>%s</info> to <info>%s</info>', $category->getName(), $user->getName()));
                }
            }
        }

        $em->flush();

        $output->writeln('<comment>Done!</comment>');
    }

    private function runCommand($string)
    {
        // Split namespace and arguments
        $namespace = split(' ', $string)[0];

        // Set input
        $command = $this->getApplication()->find($namespace);
        $input = new StringInput($string);

        // Send all output to the console
        $returnCode = $command->run($input, $this->output);

        return $returnCode != 0;
    }
}