import React, { useState, useEffect, useContext } from 'react';
import { ItemsContext } from '../ItemsContext';
import { useParams, useNavigate } from 'react-router-dom';

const UpdateItem = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const { updateItem } = useContext(ItemsContext);
    const [nom, setNom] = useState('');
    const [quantite, setQuantite] = useState('');

    useEffect(() => {
        const fetchItem = async () => {
            try {
                const res = await fetch(`http://localhost/liste_de_courses/items/${id}`);
                const data = await res.json();
                setNom(data.nom || '');
                setQuantite(data.quantite || '');
            } catch (error) {
                console.error("Erreur lors de la récupération de l'article :", error);
            }
        };
        fetchItem();
    }, [id]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        await updateItem(id, { nom, quantite });
        navigate('/items');
    };

    return (
        <div className='container'>
            <form className='form' onSubmit={handleSubmit}>
                <h2 className='title'>Modifier l'article</h2>
                <div>
                    <label>Nom :</label>
                    <input className='input' type="text" value={nom} onChange={(e) => setNom(e.target.value)} required />
                </div>
                <div>
                    <label>Quantité :</label>
                    <input className='input' type="text" value={quantite} onChange={(e) => setQuantite(e.target.value)} required />
                </div>
                <button className='btn' type="submit">Mettre à jour</button>
            </form>
        </div>
    );
};

export default UpdateItem;
