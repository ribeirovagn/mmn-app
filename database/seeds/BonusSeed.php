<?php

use Illuminate\Database\Seeder;
use App\Bonus;

class BonusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bonus::create([
            'name' => 'Indicação Direta',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec varius justo, sed rhoncus nulla. Phasellus efficitur semper odio sit amet volutpat'
        ]);
        Bonus::create([
            'name' => 'Mineração Fracionada',
            'description' => 'Etiam blandit tempor bibendum. Vivamus et mauris mi. Duis lacinia lorem ac eleifend dictum. Phasellus ac posuere mi. Fusce aliquet eros et vulputate placerat. Integer egestas ligula urna, non auctor orci fermentum sit amet. Morbi egestas nibh non ante vehicula cursus. Maecenas sagittis at mauris in ornare. Nunc posuere imperdiet odio eu gravida. Phasellus nisi nisi, molestie in mauris eu, fermentum aliquet ex.'
        ]);
        Bonus::create([
            'name' => 'Multi-Nível',
            'description' => 'Curabitur scelerisque eget felis et lacinia. Fusce vitae laoreet ipsum, quis congue magna. Nulla facilisi. Praesent porttitor augue nisl, vel dignissim risus tempor nec.'
        ]);
        Bonus::create([
            'name' => 'Venda direta',
            'description' => 'Pellentesque at mauris mollis tellus feugiat volutpat id at nibh. Vestibulum facilisis dictum feugiat. Vestibulum bibendum orci sed consequat lacinia. Cras sollicitudin viverra orci, nec euismod augue pharetra sit amet. Maecenas felis odio, molestie sit amet neque sed, aliquam tristique erat. Morbi tristique purus id ligula sodales consectetur. Aenean ut lobortis felis.'
        ]);
        Bonus::create([
            'name' => 'Renovação de Rede',
            'description' => 'Maecenas tincidunt maximus turpis sed sagittis. Vestibulum fermentum ornare est, at elementum leo. Nulla varius luctus justo non iaculis. Mauris ultricies lorem nec dolor fermentum viverra.'
        ]);
        Bonus::create([
            'name' => 'Plano de Carreira',
            'description' => 'Maecenas dignissim eget justo vitae fermentum. Etiam malesuada placerat ipsum. Mauris feugiat non libero vel suscipit. Proin dignissim tortor laoreet blandit sagittis. Curabitur nibh odio, pharetra in placerat ut, sodales eget massa. Vivamus volutpat, nibh non convallis imperdiet'
        ]);
    }
}
