<?php

namespace App\Console\Commands;

use Heritage\Console\Command;
use Ugarit\Chisel\Chisel;
use Ugarit\Chisel\Question;
use Ugarit\Chisel\Script;

use function Ugarit\Prompts\multiselect;
use function Ugarit\Prompts\spin;

class InstallFeaturesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:features
        {--answers= : JSON string of answers to skip interactive prompts}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Choose which starter kit features to keep';

    public function handle(): int
    {
        if ($this->shouldDeferInstallerHooks()) {
            return self::SUCCESS;
        }

        if (! file_exists(base_path('chisel.php'))) {
            return self::SUCCESS;
        }

        /** @var Script $script */
        $script = require base_path('chisel.php');

        $providedAnswers = $this->option('answers') === null
            ? []
            : json_decode((string) $this->option('answers'), true, 512, JSON_THROW_ON_ERROR);

        $answers = $script
            ->collectAnswers()
            ->onQuestion(fn (Question $question) => multiselect(
                label: $question->label,
                options: $question->options,
                default: $question->default ?? [],
                required: $question->required,
                hint: $question->hint,
            ))
            ->interactive($this->input->isInteractive())
            ->withAnswers($providedAnswers);

        $skipNode = $this->shouldSkipNode();

        if (! $skipNode) {
            $this->installNodeDependencies();
        }

        $script->chisel($answers);

        if (! $skipNode) {
            $this->buildAssets();
        }

        return self::SUCCESS;
    }

    protected function shouldDeferInstallerHooks(): bool
    {
        if ($this->option('answers') !== null) {
            return false;
        }

        return $this->installerFlag('UGARIT_INSTALLER_DEFER_HOOKS');
    }

    protected function shouldSkipNode(): bool
    {
        return $this->installerFlag('UGARIT_INSTALLER_NO_NODE');
    }

    protected function installerFlag(string $name): bool
    {
        return filter_var(
            $_ENV[$name] ?? $_SERVER[$name] ?? getenv($name),
            FILTER_VALIDATE_BOOL,
        );
    }

    protected function installNodeDependencies(): void
    {
        $npm = Chisel::in(base_path())->npm();
        $packageManager = $npm->packageManager();

        spin(
            fn () => $npm->install(),
            "Installing dependencies with {$packageManager->value}...",
        );
    }

    protected function buildAssets(): void
    {
        $npm = Chisel::in(base_path())->npm();

        spin(
            fn () => $npm->run('build'),
            'Building assets...',
        );
    }
}
