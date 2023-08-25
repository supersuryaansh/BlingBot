<?php

include __DIR__.'/vendor/autoload.php';
require('Hashtags.php');
require('token.php');

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Interactions\Command\Command; // Please note to use this correct namespace!
use Discord\Parts\Interactions\Interaction;
use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\TextInput;
use Discord\Helpers\Collection;

$discord = new Discord(['token'=>TOKEN]); // DiscordCommandClient works too


// $hastag = new Hashtags("tag-box tag-box-v3 margin-bottom-40","chandrayaan3");
// $hastag->domParser();
// Handle the command
 $discord->listenCommand('hashtag', function (Interaction $interaction) {
     // var_dump($interaction->data->options->get('name', 'parameter_name')->value);
      $ar = ActionRow::new();
$ti = TextInput::new('Keyword for Hashtags', TextInput::STYLE_SHORT, 'first');
$ar->addComponent($ti);
$customId = '123';
$interaction->showModal('Instagram Hashtag Generator', $customId, [$ar], function (Interaction $interaction, Collection $components) {
    // echo "\n\n".var_dump($components['first']->value)."\n\n"
    $hastag = new Hashtags("tag-box tag-box-v3 margin-bottom-40",$components['first']->value);
    $message = $hastag->domParser();

    $interaction->respondWithMessage(MessageBuilder::new()->setContent($message));
    $interaction->acknowledge();

});
});
