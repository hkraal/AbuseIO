<?php

namespace AbuseIO\Console\Commands\Netblock;

use AbuseIO\Console\Commands\AbstractListCommand;
use AbuseIO\Models\Netblock;

class ListCommand extends AbstractListCommand
{

    /**
     * The console command name.
     * @var string
     */
    protected $signature = 'netblock:list
                            {--filter= : Applies a filter on the first_ip }
    ';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Shows a list of all available netblocks';

    /**
     * The headers of the table
     * @var array
     */
    protected $headers = ['Id', 'Contact', 'First IP', 'Last IP'];

    /**
     * The fields of the table / database row
     * @var array
     */
    protected $fields = ['first_ip', 'last_ip']; // don't know how to do the field contact conform this syntax.

    /**
     * {@inheritdoc }
     */
    protected function transformListToTableBody($list)
    {
        $netblocks = [];
        /* @var $netblock  \AbuseIO\Models\Netblock|null */
        foreach ($list as $netblock) {
            $netblocks[] = [$netblock->id, $netblock->contact->name, $netblock->first_ip, $netblock->last_ip];
        }
        return $netblocks;
    }

    /**
     * {@inheritdoc }
     */
    protected function findWithCondition($filter)
    {
        return Netblock::where('first_ip', 'like', "%{$filter}%")->get();
    }

    /**
     * {@inheritdoc }
     */
    protected function findAll()
    {
        return Netblock::all();
    }

    /**
     * {@inheritdoc }
     */
    protected function getAsNoun()
    {
        return "netblock";
    }
}
