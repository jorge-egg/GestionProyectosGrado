<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class sub_itemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_items')->insert([

            'codigo' => '001',
            'SubItem' => '1.1 El título es coherente y adecuado con el contenido del Proyecto',
            'item' => 1,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '002',
            'SubItem' => '1.2 Contiene el qué, para qué y cómo',
            'item' => 1,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '003',
            'SubItem' => '2.1 Se ha hecho un análisis profundo sobre el tema, basado en información pertinente',
            'item' => 6,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '004',
            'SubItem' => '2.2 Se ha identificado y planteado el problema (o hipótesis) claramente',
            'item' => 6,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '005',
            'SubItem' => '2.3 Los objetivos están visiblemente presentados en la introducción',
            'item' => 6,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '006',
            'SubItem' => '2.4 Los objetivos guardan relación de correspondencia con el título, metodología y resultados esperados',
            'item' => 6,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '007',
            'SubItem' => '2.5 Existe correlación con la fundamentación de las secciones de anteproyecto',
            'item' => 6,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '008',
            'SubItem' => '2.6 Las citas referenciadas son adecuadas',
            'item' => 6,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '009',
            'SubItem' => '3.1 Se Describe de manera precisa clara y completa el problema',
            'item' => 7,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '010',
            'SubItem' => '3.2 La formulación del problema se hace a modo de pregunta y es coherente con los objetivos',
            'item' => 7,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '011',
            'SubItem' => '3.3 El objetivo general tiene una relación clara y consistente con la descripción del problema, y responde al menos ¿Qué se va a hacer?, ¿Cómo? y ¿Para qué?',
            'item' => 7,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '012',
            'SubItem' => '3.4 Los objetivos específicos describen el proceso a seguir para lograr el objetivo general. Son alcanzables, medibles y demostrables. Dan respuesta a una o más de las preguntas ¿Cuál será el conocimiento generado si el trabajo se realiza? ¿Qué solución, producto o tecnológica se espera desarrollar?',
            'item' => 7,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '013',
            'SubItem' => '3.5 Las citas referenciadas son adecuadas',
            'item' => 7,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '014',
            'SubItem' => '4.1 La justificación responde a preguntas de ¿Por qué y para qué es necesario este proyecto o investigación? ¿Qué beneficios se obtienen?',
            'item' => 8,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '015',
            'SubItem' => '4.2 Es evidente la importancia, utilidad, novedad y aporte a la disciplina',
            'item' => 8,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '016',
            'SubItem' => '4.3 Las citas referenciadas son adecuadas',
            'item' => 8,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '017',
            'SubItem' => '5.1 Marco contextual: Presenta el marco contextual acorde con el entorno: macroentorno y microentorno',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '018',
            'SubItem' => '5.1.1 Las citas referencias son adecuadas',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '019',
            'SubItem' => '5.2 Marco teórico: Presenta el marco teórico, referenciando antecedentes y postulados teóricos',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '020',
            'SubItem' => '5.2.1 Las citas referencias son adecuadas',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '021',
            'SubItem' => '5.3 Marco legal: Plantea la normatividad que regula el proyecto de investigación de acuerdo al tema',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '022',
            'SubItem' => '5.3.1 Las citas referencias son adecuadas',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '023',
            'SubItem' => '5.4 Marco conceptual: Conceptualiza de manera técnica los términos propios de la investigación, que requieran ser definidos a partir del proyecto de investigación',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '024',
            'SubItem' => '5.4.1 Las citas referencias son adecuadas',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '025',
            'SubItem' => '5.5 El estado del arte, tiene coherencia con el proyecto y sus referencias son actuales',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '026',
            'SubItem' => '5.5.1 Las citas referencias son adecuadas',
            'item' => 9,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '027',
            'SubItem' => '6.1 La línea de investigación es acorde tanto con los lineamientos institucionales como con el proyecto de investigación',
            'item' => 10,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '028',
            'SubItem' => '6.2 Hay claridad en el paradigma investigativo respecto a enfoque, tipo y método de investigación.',
            'item' => 10,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '029',
            'SubItem' => '6.3 Se define con claridad el universo investigativo: población y muestra de acuerdo al proyecto de investigación',
            'item' => 10,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '030',
            'SubItem' => '6.4 Describe las fuentes para la recolección de información que serán utilizadas en el proyecto',
            'item' => 10,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '031',
            'SubItem' => '6.5 Propone los/las herramientas de recolección de información que serán utilizadas en el proyecto de investigación',
            'item' => 10,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '032',
            'SubItem' => '6.6 Las citas referencias son adecuadas',
            'item' => 10,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '033',
            'SubItem' => '7.1 Describe detalladamente las tareas que se llevarán a cabo durante la ejecución del proyecto.',
            'item' => 11,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '034',
            'SubItem' => '7.2 Describe los plazos en que cada actividad deberá completarse.',
            'item' => 11,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '035',
            'SubItem' => '7.3 Presenta los recursos físicos y/o Tecnológico, así como también el Talento humano y el presupuesto proyectado
            para la ejecución del proyecto de investigación, acorde con el cronograma de actividades a desarrollar.',
            'item' => 11,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '036',
            'SubItem' => '8.1 El texto está bien redactado, con buena ortografía, coherencia y organización',
            'item' => 12,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '037',
            'SubItem' => '8.2 Cumple con la aplicación de las normas vigentes de presentación en el documento',
            'item' => 12,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '038',
            'SubItem' => '8.3 Las figuras y tablas son de buena calidad y se citan en el documento',
            'item' => 12,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '039',
            'SubItem' => '8.4 Hay literatura consultada en un segundo idioma y de los últimos 5 años',
            'item' => 12,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '040',
            'SubItem' => '8.5 Las referencias son pertinentes al objeto de investigación',
            'item' => 12,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '041',
            'SubItem' => '8.6 Las referencias se citan de acuerdo con la norma APA',
            'item' => 12,
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '042',
            'SubItem' => '8.7 Las fuentes de consulta son fiables con autor específico y contienen rigor científico. (mínimo 15 referencias)',
            'item' => 12,
        ]);


    }
}
