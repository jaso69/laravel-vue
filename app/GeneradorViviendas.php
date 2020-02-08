<?php


namespace App;


use App\Vivienda;
use phpDocumentor\Reflection\Types\Object_;
use PhpParser\Node\Expr\Cast\String_;


class GeneradorViviendas
{
    protected $tipo, $planta, $letra, $escalera, $id;
    protected $letras = [
                'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','W','X','Y','Z'
            ];
    /**
     * GeneradorViviendas constructor.
     */
    public function __construct($tipo, $planta, $letra, $escalera, $id)
    {
        $this->tipo = $tipo;
        $this->planta = (int) $planta;
        $this->letra = $letra;
        $this->escalera = $escalera;
        $this->id = $id;
        $this->generador();
    }

    protected function grabar($p, $l){
        Vivienda::create([
            'comunidad_id' => $this->id,
            'tipo' => $this->tipo,
            'escalera' => $this->escalera,
            'planta' => (string) $p,
            'letra' => $l,
        ]);
    }

    protected function generador(){
        $clave = array_search($this->letra, $this->letras);
        $letras_asign = array_slice($this->letras, 0, $clave + 1);
        for ($p = 1; $p <= $this->planta; $p++) {
            foreach ($letras_asign as $l) {
               $this->grabar($p, $l);
            }
        }
    }
}
