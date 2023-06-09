<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('post_translations')->delete();

        \DB::table('post_translations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'post_id' => 1,
                'locale' => 'nl',
                'slug' => 'Lekkernassuh-Timebank-evenement',
                'title' => 'Timebanken waar is dat nou goed voor ?!',
                'excerpt' => 'Een evenement speciaal voor Lekkernassûh medewerkers en lekker nassûhende timebankers.',
                'content' => 'Een evenement speciaal voor Lekkernassûh medewerkers en lekker nassûhende timebankers over waarom Lekkernassûh met Timebank werkt en hoe je direct méér, echt veel meer, met die Timebank Uren kunt doen.

Kom op [dag en datum] om [tijd] naar de Gymzaal !',
                'status' => 1,
                'start' => '2023-06-03 15:46:00',
                'created_at' => '2023-06-01 12:50:11',
                'updated_at' => '2023-06-01 12:50:11',
                'stop' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'post_id' => 1,
                'locale' => 'en',
                'slug' => 'Lekkernassuh-Timebank-event',
                'title' => 'Timebanking, what is it good for ?!',
                'excerpt' => 'An event especially for Lekkernassuh workers.',
                'content' => 'An event especially for Lekkernassuh workers and l..An event especially for Lekkernassuh workers and l..An event especially for Lekkernassuh workers and l..',
                'status' => 1,
                'start' => '2023-06-03 15:46:00',
                'created_at' => '2023-06-01 12:51:11',
                'updated_at' => '2023-06-01 12:51:11',
                'stop' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'post_id' => 3,
                'locale' => 'nl',
                'slug' => 'Lekkernassuh-samenwerking',
                'title' => 'Jouw tijd, jouw verdienste',
                'excerpt' => 'Sinds 2018 werkt Lekkernassûh samen met Timebank.cc.',
                'content' => 'Sinds 2018 werkt Lekkernassûh samen met Timebank.cc. Timebank.cc is een Community Currency, toegankelijk voor iedereen, om je tijd, vaardigheden en kennis te delen. Bij Lekkernassûh kun je Timebank uren verdienen door mee te helpen op een versmarkt of in de verpakkingsvrije winkel. Met deze uren kun je bijvoorbeeld je goentepakket, kaas en producten van de verpakkingsvrije winkel kopen.

Om de Lekkernassûh markt en de organisatie ervan draaiende te houden hebben we geld (Euro’s) en arbeid (tijd) nodig. Met de Euro’s betalen we groenten, de kosten van het pand, internet, logistiek en dergelijke. Daarnaast hebben we menskracht nodig om van alles gedaan te krijgen. Met Timebank.cc creëren we de mogelijkheid om gewerkte uren te waarderen met Timebank uren, die je vervolgens weer uit kunt geven bij Lekkernassûh of in de Timebank.cc gemeenschap.
Foto door finefocus.nl',
                'status' => 1,
                'start' => NULL,
                'created_at' => '2023-06-01 13:14:23',
                'updated_at' => '2023-06-01 13:14:23',
                'stop' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'post_id' => 3,
                'locale' => 'en',
                'slug' => 'Lekkernassuh-coorperation',
                'title' => 'Earn Timebank hours for your time',
                'excerpt' => 'Since 2018, Lekkernassuh has partnered with Timebank.cc.',
                'content' => 'Since 2018, Lekkernassuh has partnered with Timebank.cc, which is a Community Currency, accessible to everyone, as a way to share time, skills and knowledge. At Lekkernassûh, you can help out at the market and earn Timebank hours. These hours can be used to buy things like your veggie package, cheese and products from the package-free shop.

To keep the Lekkernassûh market and its organization running, we need money (euros) and labor (time). With Euros, we pay for vegetables, the cost of the premises, internet, logistics among other similar things. With Timebank hours, we create the possibility to credit hours worked with Timebank hours, which can then be spent at Lekkernassûh or in other ways within the Timebank.cc community.',
                'status' => 1,
                'start' => '2023-05-01 15:46:00',
                'created_at' => '2023-06-01 13:16:12',
                'updated_at' => '2023-06-01 13:16:12',
                'stop' => '2023-06-01 20:33:43',
            ),
        ));


    }
}