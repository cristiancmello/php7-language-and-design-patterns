<?php
// Exemplo 2: definindo um namespace
// IMPORTANTE: A DEFINIÇÃO DE NAMESPACE SEMPRE DEVE VIR NO TOPO DO ARQUIVO, A MENOS QUE EXISTA `declare()` JÁ NO TOPO
declare(strict_types=1);

// Subnamespaces: Em PHP, é possível definir hierarquia usando '\'
namespace My\Project;   // Nível 1: My; Nível 2: Project

const CONNECT_OK = 1;
class Connection {}
function connection(){ }