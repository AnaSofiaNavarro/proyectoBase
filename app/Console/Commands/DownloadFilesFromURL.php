<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use App\Models\Acuerdo; // Modelo que contiene los nombres de los archivos
use App\Models\Edicto;
use App\Models\Legislacion;

class DownloadFilesFromURL extends Command
{
    //Con este comando se ejecuta desde consola
    // php artisan download:files https://poderjudicialchiapas.gob.mx/archivos/manager/edictos/ --path=descargas

    protected $signature = 'download:files {url} {--path= : Ruta donde se guardarán los archivos}';
    protected $description = 'Descarga archivos específicos de una URL basados en los nombres almacenados en la base de datos.';

    public function handle()
    {
        $url = rtrim($this->argument('url'), '/'); // Asegurar que la URL no tenga "/" al final
        $path = $this->option('path') ?? 'downloads'; // Carpeta donde se guardarán los archivos

        // Obtener la lista de archivos desde la base de datos
        // $archivosRequeridos = Acuerdo::pluck('archivo')->toArray();
        // $archivosRequeridos = Edicto::pluck('archivo')->toArray();
        $archivosRequeridos = Legislacion::pluck('archivo')->toArray();

        if (empty($archivosRequeridos)) {
            $this->error('No hay archivos requeridos en la base de datos.');
            return;
        }

        // Crear la carpeta si no existe
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        $client = new Client(['verify' => false]); // Desactiva la verificación SSL temporalmente si sigue dando error

        foreach ($archivosRequeridos as $archivo) {
            $archivoUrl = "{$url}/{$archivo}"; // Construir la URL del archivo
            $archivoDestino = "{$path}/{$archivo}"; // Ruta local donde se guardará

            $this->info("Descargando: {$archivoUrl}");

            try {
                // Hacer la solicitud GET para descargar el archivo
                $response = $client->get($archivoUrl);
                $content = $response->getBody()->getContents();

                // Guardar el archivo en la carpeta de almacenamiento de Laravel
                Storage::put($archivoDestino, $content);

                $this->info("Archivo guardado en: {$archivoDestino}");
            } catch (\Exception $e) {
                $this->error("Error al descargar {$archivoUrl}: " . $e->getMessage());
            }
        }

        $this->info('Descarga completada.');
    }
}
