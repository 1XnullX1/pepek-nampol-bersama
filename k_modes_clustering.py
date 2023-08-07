import pandas as pd
from kmodes.kmodes import KModes

def perform_k_modes_clustering(data_file):
    # Load data from CSV (you can modify this to fetch data from the database using libraries like pandas or sqlalchemy)
    data = pd.read_csv(data_file)

    # Perform K-Modes Clustering
    km = KModes(n_clusters=3, init='Huang', n_init=5, verbose=1)
    clusters = km.fit_predict(data)

    # Add the cluster labels to the DataFrame
    data['cluster'] = clusters

    # Save the clustered data to a new CSV file
    data.to_csv('clustered_data.csv', index=False)

if __name__ == '__main__':
    data_file = 'user_log_data.csv'
    perform_k_modes_clustering(data_file)
