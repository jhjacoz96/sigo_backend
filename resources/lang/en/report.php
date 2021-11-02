<?php

return [
	'ham' => [
		'matrix' => [
			'title' => 'Risk matrix',
			'danger' => 'danger',
			'risk_assessment' => 'risk assessment',
			'level' => 'level',
			'legend' => [
				'legend' => 'legend',
				'low' => 'low',
				'medium' => 'medium',
				'tall' => 'tall',
				'very_high' => 'very high'
			],
			'probability' => [
				'probability' => 'probability',
				'rare' => '1. rare',
				'unlikely' => '2. unlikely',
				'possible' => '3. possible',
				'Probable' => '4. Probable',
				'Almost_sure' => '5.  Almost sure'
			],
			'consequence' => [
				'consequence' => 'consecuencia',
				'insignificant' => '1. Insignificante',
				'less' => '2. less',
				'sub' => 'CONSEQUENCE',
				'moderate' => '3. Moderado',
				'higher' => '4. higher',
				'catastrophic' => '5. catastrophic'
			],
		],
		'rain' => [
			'brainstorming' => ' brainstorming/ selection grid',
			'title'=> 'brainstorming'
		],
		'dao'=>[
			'title'=> 'SWOT analysis',
			'strengths'=>'strengths',
			'Weaknesses'=>'Weaknesses',
			'Opportunities'=>'Opportunities',
			'Threats'=>'Threats',
			'INTERNAL'=>'INTERNAL',
			'swot_strategies'=>'swot strategies',
			'Threats'=> 'Threats',
			'STRATEGY_F_O' =>'STRATEGY F-O',			
			'STRATEGY_D_O'=>'STRATEGY D-O',
			'STRATEGY_F_A'=>'STRATEGY F-A',
			'STRATEGY_D_A'=>'STRATEGY D-A',
			'SWOT_STRATEGIES' =>'SWOT STRATEGIES'
		]
	],


	'pda' => [
		'title-head' => 'Action plan report',
		'title' => 'Action plan',
		'definition-of-problem' => [
			'title' => 'Definition of the problem / members',
			'field-situation_treated' => 'Situation to be treated',
			'field-objective' => 'Objective',
			'field-lider' => 'Leader (s)',
			'field-invited' => 'Guest (s)',
		],
		'analysis_method'  => [
			'title' => 'Analysis',
			'ishikawa' => 'Ishikawa diagram',
			'5why' => 'Analysis of the 5 because',
			'pareto' => 'Pareto',
			'other' => 'Other methods',
			'brainstorming' => 'brainstorming',
			'cause_resume' => 'Summary of selected causes',
		],
		'label' => [
			'title' => 'Title',
			'why' => 'Why?',
			'root_cause' => 'Root cause',
			'nro' => 'Nro.',
			'identified_cause' => 'Identified cause',
			'magnitude' => 'Measured quantity',
			'method' => 'Method',
			'evidences' => 'Evidence',
			'action' => 'Actions Executed',
			'description' => 'Description',
			'deadline' => 'Deadline',
			'actual_date' => 'Actual date',
			'responsible_of' => 'Responsible of ',
			'causes' => 'Causes',
			'total' => 'Total',
			'selection' => 'Selection'
		],
		'action' => [
			'title' => 'Actions',
			'nro' => 'Nro.',
			'task' => 'Task',
			'responsible' => 'Responsable',
			'date_plan' => 'Plan date',
			'stage' => 'Stage',
			'state' => 'State'
		],
		'statistics' => [
			'title-pda_general' => 'Action plan statistics',
			'title-pda_responsable' => 'Action plan statistics per participant',
			'stage' => [
				'title' => 'Stage',
				'not_treated' => 'Not treated',
				'notified' => 'Notified',
				'planned' => 'Planned',
				'in_action' => 'In action',
				'executed' => 'Executed',
				'validated' => 'Validated'
			],
			'status' => [
				'title' => 'State',
				'Active' => 'Active',
				'on_date' => 'On date',
				'in_no_date' => 'In not date',
				'history' => 'In historical'
			],
		],
		'resource-summary' => [
			'title' => 'Resource Summary',
			'task' => 'TASK',
			'materials' => 'materials',
			'service' => 'Services',
			'cost' => 'Costs',
			'materials-alt' => 'MATERIALS',
			'service-alt' => 'SERVICES',
			'costo-alt' => 'COSTS',
			'total' => 'TOTAL'
		]
	],
	'sieni' => [
		'title' => 'Evaluation report',
		'col' => [
			'requirement' => 'Requirement',
			'evidence' => 'Evidence',
			'note' => 'Observation',
			'oportunity' => 'Opportunity for improvement',
			'non-conformity' => 'Nonconformity',
			'dep' => 'Dep.',
			'eval' => 'Eval.',
			'classification' => 'classification',
			'date_inconsistency' => 'date of inconsistency'
		],
		'field-code' => 'Code',
		'info-doc' => [
			'title_preserve' => 'Requirements: Preserve documented information',
			'body_preserve' => 'Below are the requirements associated with preserve documented information during the evaluation concluded on the day',
			'title_maintain' => 'Requirements: Maintain documented information',
			'body_maintain' => 'Below are the requirements associated with Maintaining documented information during the evaluation concluded on the day',
		],
		'process' => [
			'process' => 'Process',
			'compliance-weight' => 'Weighted Compliance',
			'effectiveness' => 'Effectiveness',
			'evaluated' => 'Evaluated requirements',
			'compliance' => 'Compliance requirements',
			'non-conformity' => 'Nonconforming requirements'
		],
		'global-result' => [
			'structure' => 'Evaluated structure',
			'goal' => 'Goal',
			'result' => 'Result',
			'conformity' => 'Conformity'
		],
		'result' => [
			'organization' => 'Organization',
			'module' => 'Module',
			'date' => 'Date',
			'result-global' => 'Global Result',
			'conformable' => 'Conformable',
			'notes' => 'Observations',
			'oportunity' => 'Opportunity for improvement',
			'non-conformity' => 'Nonconformities',
			'takers' => 'Takers',
			'sources' => 'Informant Units',
		],
		'signs' => [
			'takers' => 'Signature (s) taker (s)',
			'sources' => 'Signature (s) Informant (s) Unit (s)',
		]
	],
	'nc' => [
		'title' => "Nonconformity Manager",
		'field-code' => 'Nonconformity: Code',
		'title_treatment' => 'Nonconformity treatment',
		'title_nc' => 'Nonconformity record',
		'field-date_issue' => 'Date',
		'field-company_name' => 'Organization',
		'field-created_by' => 'Created by',
		'field-title' => 'NC',
		'status' => [
			'register' => 'Register',
			'validation' => 'Validation',
			'analisys' => 'Analysis',
			'action-plan' => 'Action Plan',
			'verification' => 'Verification',
			'execution' => 'Execution',
			'effectiveness' => 'Effectiveness',
			'approval' => 'Approval',
		],
		'label' => [
			'why' => '¿Why?',
			'title' => 'Title',
			'root_cause' => 'Root cause',
			'nro' => 'No.',
			'identified_cause' => 'Cause identified',
			'magnitude' => 'Measured magnitude',
			'method' => 'Method',
			'evidences' => 'Evidences',
			'nc' => 'Nonconformity',
			'action' => 'Entry Actions',
			'description' => 'Descripción',
			'deadline' => 'Deadline',
			'actual_date' => 'Actual date',
			'responsible_of' => 'Responsible of'

		],
		'section'  => [
			'action-plan-execution' => "Action plan",
			'action-plan' => "Action plan",
			'effectiveness' => "Effectiveness",
			'ishikawa' => "Ishikawa's diagram",
			'5why' => "Analysis of the 5 because",
			'pareto' => "Pareto",
			'other' => "Other methods",
			'cause_resume' => "Summary of selected causes",
		],
		'action-plan' => [
			'title' => "Action plan",
			'what' => '¿What was planned to do?',
			'how' => '¿How was planned to do?',
			'when' => '¿When was it planned to do?',
			'where' => '¿Where was planned to do? / ¿Where did it apply?',
			'resource' => '¿What resources were needed?',
			'who-execute' => '¿Who executed?',
			'who-valid' => '¿Who evaluated?',
			'comply' => '¿Was the plan fulfilled',
			'yes' => 'Yes',
			'no' => 'No',
			'comment' => 'Comments',
			'effectiveness' => "¿The actions executed were effective?",
			'evidence' => "Evidences",
			'causes' => "Causes associated with the action"
		]
	],
	'gd' => [
		'title' => 'Documented Information Manager',
		'date' => 'Date',
		'resource' => [
			'title' => 'Resource',
			'created_by' => 'Created By',
			'section' => [
				'summary_state' => 'Resources Summary Report by State',
				'graphic' => 'Summary',
				'list' => 'Documents',
			],
			'list' => [
				'col-name' => 'Name',
				'col-path' => 'Folder',
				'col-status' => 'Status',
				'col-approval' => 'Approval',
				'col-review' => 'Review Date',
				'col-link' => 'Link',
			],
			'status' => [
				'valid' => 'Valid',
				'to-expire' => 'To Expire',
				'expire' => 'Expire'
			]
		],
		'process' => [
			'title' => 'Process Characterization',
			'section' => [
				'process-maps' => 'Process Map',
				'characters' => 'Characterization of the Processes',
				'document-information' => 'Documented Information'
			],
			'process-maps' => [
				'process' => 'Processes',
				'process-maps' => 'Process Map',
				'process-strategy' => 'Strategic processes',
				'process-support' => 'Support processes',
				'source-in' => 'Input sources',
				'process-in' => 'Process inputs',
				'process-box' => 'PROCESS',
				'process-out' => 'Process outputs',
				'receiver-out' => 'Output receivers',
			],
			'characters' => [
				'process' => 'Process',
				'process-name' => 'Process name',
				'document' => 'Document',
				'owner' => 'Owner of the process',
				'version' => 'Version',
				'objective' => 'Objective',
				'last-updated' => 'Last modified',
				'scope' => 'Scope',
				'status' => 'Status',
				'status-active' => 'Active',
				'status-inactive' => 'Inactive',
			],
			'document-information' => [
				'view' => 'View'
			],
			'public-statement' => 'GID Public Declaration Report'
		]
	],
	'organization' => 'Organization',
	'copyright' => 'Copyright',
	'page' => 'Page'

];
