<?php 
/**
 * This is a Vason pagecontroller.
 *
 */
// Include the essential config-file which also creates the $vason variable with its defaults.
include(__DIR__.'/config.php'); 
 
 
// Do it and store it all in variables in the Vason container.
$vason['title'] = "Welcome to Vason";
 
$vason['main'] = <<<EOD
<h1>Välkommen</h1>
<p>Detta är en exempelsida som visar hur Vason ser ut och fungerar.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus aspernatur reprehenderit 
ratione facilis, sapiente adipisci ducimus quis similique excepturi atque. Laudantium optio, voluptates 
ab earum quo blanditiis autem facere soluta. Eveniet accusamus optio iusto quas reprehenderit corporis 
velit magnam, assumenda impedit nostrum maxime officia minus, voluptatem culpa pariatur, natus quo, rerum 
officiis! Beatae aliquam accusamus minus excepturi ab eius quidem necessitatibus ex, nemo in, enim non 
officia deserunt, omnis sed odit assumenda at facilis illum delectus provident aspernatur. Earum sint 
amet suscipit atque accusamus eius fuga sapiente distinctio cupiditate id quibusdam, ipsa velit excepturi 
praesentium voluptatibus mollitia neque minus. Repellat nisi deleniti cupiditate animi doloremque accusamus 
unde facilis quia quisquam, hic eveniet reprehenderit culpa, voluptate ipsam veniam dolor odio in optio 
obcaecati et aut. Quaerat repellat optio qui aliquam odit dolorem, perferendis natus possimus fuga laboriosam, 
eligendi mollitia in eos recusandae ipsa sunt. Excepturi error ipsum magnam qui quae soluta aspernatur 
facere natus quod beatae aperiam cumque est rem, sit laboriosam dolorem hic, consectetur repellat. Explicabo 
repellat nulla, inventore impedit necessitatibus porro quae maxime quia repudiandae. Dicta, quas excepturi. 
Accusamus numquam cumque quaerat, eius. Unde rem labore quia blanditiis eligendi non, nobis repellendus 
corporis, eveniet officia architecto, esse placeat assumenda.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae dolorem, architecto nostrum tempora 
quos corporis corrupti, incidunt perferendis, quisquam porro dignissimos quod quidem ad minima inventore 
reprehenderit, blanditiis error. Velit ea blanditiis laudantium possimus harum est aliquam. Aspernatur, 
non officiis eveniet consequatur soluta doloremque dolor fugiat, ullam facilis omnis itaque?</p>
EOD;

// Finally, leave it all to the rendering phase of Vason.
include(VASON_THEME_PATH);