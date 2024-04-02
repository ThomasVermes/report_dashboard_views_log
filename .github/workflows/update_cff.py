# -*- coding: utf-8 -*-
"""
Created on Tue Mar 26 11:44:39 2024
This script get the new release tag and date and put it automatically in the citation file
@author: vermest
"""
import yaml
import datetime
import os

# Definisci i nuovi valori per versione e data di rilascio
new_version = os.environ.get('RELEASE_TAG')
new_release_date = datetime.datetime.now().strftime('%Y-%m-%d')

# Ottieni il percorso assoluto del file CITATION.cff
script_dir = os.path.dirname(os.path.abspath(__file__))
cff_file_path = os.path.join(script_dir, "../../CITATION.cff")

# Leggi il contenuto del file CITATION.cff
with open(cff_file_path, 'r') as file:
    cff_data = yaml.safe_load(file)

# Aggiorna i valori dei campi version e date-released
cff_data['version'] = new_version
cff_data['date-released'] = new_release_date

# Sovrascrivi il file con i dati aggiornati
with open(cff_file_path, 'w') as file:
    yaml.dump(cff_data, file)
