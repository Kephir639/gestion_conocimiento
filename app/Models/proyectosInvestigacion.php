<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProyectosInvestigacion extends Model
{
    use HasFactory;

    protected $table = 'proyectos_investigacion';
    protected $fillable = [
        'ano_ejecucion',
        'codigo_sigp',
        'nombre_proyecto',
        'resumen_proyecto',
        'objetivo_general',
        'propuesta',
        'tipologia',
        'impacto',
        'estado_p_investigacion'
    ];

    public function getAnoEjecucion()
    {
        return $this->ano_ejecucion;
    }

    public function getCodigoSigp()
    {
        return $this->codigo_sigp;
    }

    public function getNombreProyecto()
    {
        return $this->nombre_proyecto;
    }

    public function getResumenProyecto()
    {
        return $this->resumen_proyecto;
    }

    public function getObjetivoGeneral()
    {
        return $this->objetivo_general;
    }

    public function getPropuesta()
    {
        return $this->propuesta;
    }

    public function getTipologia()
    {
        return $this->tipologia;
    }

    public function getImpacto()
    {
        return $this->impacto;
    }

    public function getEstadoPInvestigacion()
    {
        return $this->estado_p_investigacion;
    }

    public function setAnoEjecucion($anoEjecucion)
    {
        $this->attributes['ano_ejecucion'] = $anoEjecucion;
    }

    public function setCodigoSigp($codigoSigp)
    {
        $this->attributes['codigo_sigp'] = $codigoSigp;
    }

    public function setNombreProyecto($nombreProyecto)
    {
        $this->attributes['nombre_proyecto'] = $nombreProyecto;
    }

    public function setResumenProyecto($resumenProyecto)
    {
        $this->attributes['resumen_proyecto'] = $resumenProyecto;
    }

    public function setObjetivoGeneral($objetivoGeneral)
    {
        $this->attributes['objetivo_general'] = $objetivoGeneral;
    }

    public function setPropuesta($propuesta)
    {
        $this->attributes['propuesta'] = $propuesta;
    }

    public function setTipologia($tipologia)
    {
        $this->attributes['tipologia'] = $tipologia;
    }

    public function setImpacto($impacto)
    {
        $this->attributes['impacto'] = $impacto;
    }

    public function setEstadoPInvestigacion($estadoPInvestigacion)
    {
        $this->attributes['estado_p_investigacion'] = $estadoPInvestigacion;
    }
}
