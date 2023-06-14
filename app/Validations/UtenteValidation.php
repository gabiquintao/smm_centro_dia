<?php

namespace App\Validations;
use Illuminate\Validation\Rule;

class UtenteValidation
{
    public static function validateSave(array $formData): array
    {
        return [
            'nome' => 'required',
            'nome_trata' => 'required',
            'tlm' => '',
            'tlf' => '',
            'email' => '',
            'dt_nasc' => '',
            'tipo_estado_civil' => '',
            'cc' => '',
            'nif' => '',
            'ss' => '',
            'num_utente' => '',
            'obs' => '',

            //
            'infOutras.morada' => '',
            'infOutras.cp1' => '',
            'infOutras.cp2' => '',
            'infOutras.localidade' => '',
            'infOutras.is_proximo_na_instituicao' => '',
            'infOutras.proximo_na_instituicao' => '',
            'infOutras.tipo_visita' => '',
            'infOutras.dt_visita' => '',
            'infOutras.naturalidade' => '',
            'infOutras.tipo_habilitacoes' => '',
            'infOutras.habilitacoes_desc' => '',

            //
            'infEconomica.rendimento_trabalho' => 'required',
            'infEconomica.reforma' => '',
            'infEconomica.pensao' => '',
            'infEconomica.complemento_dep' => '',
            'infEconomica.outro_rendimento' => '',
            'infEconomica.medicacao' => '',
            'infEconomica.renda' => '',
            'infEconomica.agua' => '',
            'infEconomica.gaz' => '',
            'infEconomica.energia' => '',
            'infEconomica.telefone' => '',
            'infEconomica.alimentacao' => '',
            'infEconomica.outra_despesa' => '',

            //
            'suporte.is_necessita_suporte' => '',
            'suporte.tipo_suporte_existente' => '',
            'suporte.tipo_grau_dependencia' => '',
            'suporte.is_deficiencia_mental' => '',
            'suporte.is_deficiencia_visual' => '',
            'suporte.is_deficiencia_motora' => '',
            'suporte.is_deficiencia_auditiva' => '',
            'suporte.motivo_pedido' => 'nullable',

            'famResponsavel.id' => '',
            'famResponsavel.utente_id' => '',
            'famResponsavel.nome' => '',
            'famResponsavel.morada' => '',
            'famResponsavel.cp1' => '',
            'famResponsavel.cp2' => '',
            'famResponsavel.localidade' => '',
            'famResponsavel.tlm' => '',
            'famResponsavel.tlf' => '',
            'famResponsavel.email' => '',
            'famResponsavel.dt_nasc' => '',
            'famResponsavel.cc' => '',
            'famResponsavel.nif' => '',
            'famResponsavel.ss' => '',
            'famResponsavel.obs' => '',
            'famResponsavel.created_at' => '',
            'famResponsavel.updated_at' => '',
        ];
    }

    public static function validateSubmit(array $formData): array
    {
        return [
            'nome' => 'required',
            'nome_trata' => 'required',
            'tlm' => 'required',
            'tlf' => 'required',
            'email' => 'required',
            'dt_nasc' => 'required',
            'tipo_estado_civil' => 'required',
            'cc' => 'required',
            'nif' => 'required',
            'ss' => 'required',
            'num_utente' => 'required',
            'obs' => 'required',

            //
            'infOutras.morada' => 'required',
            'infOutras.cp1' => 'required',
            'infOutras.cp2' => 'required',
            'infOutras.localidade' => 'required',
            'infOutras.is_proximo_na_instituicao' => 'required',
            'infOutras.proximo_na_instituicao' => 'required',
            'infOutras.tipo_visita' => 'required',
            'infOutras.dt_visita' => 'required',
            'infOutras.naturalidade' => 'required',
            'infOutras.tipo_habilitacoes' => 'required',
            'infOutras.habilitacoes_desc' => 'required',

//
            'infEconomica.rendimento_trabalho' => 'required',
            'infEconomica.reforma' => 'required',
            'infEconomica.pensao' => 'required',
            'infEconomica.complemento_dep' => 'required',
            'infEconomica.outro_rendimento' => 'required',
            'infEconomica.medicacao' => 'required',
            'infEconomica.renda' => 'required',
            'infEconomica.agua' => 'required',
            'infEconomica.gaz' => 'required',
            'infEconomica.energia' => 'required',
            'infEconomica.telefone' => 'required',
            'infEconomica.alimentacao' => 'required',
            'infEconomica.outra_despesa' => 'required',

            //
            'suporte.is_necessita_suporte' => 'required',
            'suporte.tipo_suporte_existente' => 'required',
            'suporte.tipo_grau_dependencia' => 'required',
            'suporte.is_deficiencia_mental' => 'required',
            'suporte.is_deficiencia_visual' => 'required',
            'suporte.is_deficiencia_motora' => 'required',
            'suporte.is_deficiencia_auditiva' => 'required',
            'suporte.motivo_pedido' => '',

            'famResponsavel.id' => 'required',
            'famResponsavel.utente_id' => 'required',
            'famResponsavel.nome' => 'required',
            'famResponsavel.morada' => 'required',
            'famResponsavel.cp1' => 'required',
            'famResponsavel.cp2' => 'required',
            'famResponsavel.localidade' => 'required',
            'famResponsavel.tlm' => 'required',
            'famResponsavel.tlf' => 'required',
            'famResponsavel.email' => 'required',
            'famResponsavel.dt_nasc' => 'required',
            'famResponsavel.cc' => 'required',
            'famResponsavel.nif' => 'required',
            'famResponsavel.ss' => 'required',
            'famResponsavel.obs' => 'required',
            'famResponsavel.created_at' => 'required',
            'famResponsavel.updated_at' => 'required',

            'consentimento' => 'accepted',

            'famUtente.*.nome' => 'required',
            'famUtente.*.dt_nasc' => 'required',
            'famUtente.*.tipo_parentesco' => 'required',
            'famUtente.*.tipo_meio_vida' => 'required',
            'famUtente.*.rendimento_mensal' => 'required',
            'famUtente.*.is_vive_com' => 'required',
            'famUtente.*.is_frequenta' => 'required',
        ];
    }
}
