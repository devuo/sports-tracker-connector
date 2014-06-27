<?php

namespace FitnessTrackingPorting\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Yaml\Yaml;

/**
 * Sync a workout from one tracker to another.
 */
class UploadSync extends AbstractCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('upload:sync')
            ->setDescription('Upload a workout from one tracker to another.')
            ->addArgument('source-tracker', InputArgument::REQUIRED, 'The tracker where to fetch the workout( ex: polar, endomondo).')
            ->addArgument('destination-tracker', InputArgument::REQUIRED, 'The tracker where to upload the workout (ex: polar, endomondo).')
            ->addArgument('workout-id', InputArgument::IS_ARRAY, 'An array of workout IDs from the source tracker to upload to destination tracker.');
    }

    /**
     * Run the command.
     *
     * @return integer
     */
    protected function runCommand()
    {
        $workoutIds = $this->input->getArgument('workout-id');
        $configFile = $this->input->getOption('config-file');

        $config = Yaml::parse(file_get_contents($configFile), true);

        $sourceTracker = $this->getTrackerFromCode($this->input->getArgument('source-tracker'), $config);
        $destinationTracker = $this->getTrackerFromCode($this->input->getArgument('destination-tracker'), $config);

        foreach ($workoutIds as $workoutId) {
            $this->output->writeln('Syncing workout ' . $workoutId . '. ');
            $workout = $sourceTracker->downloadWorkout($workoutId);
            $destinationTracker->uploadWorkout($workout);
            $this->output->writeln('Sync completed.');
        }

        return 0;
    }
}