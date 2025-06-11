import React from 'react';
import { Head } from '@inertiajs/react';

export default function Dashboard({ auth, totalProfs, totalAdmins, totalEtudiants, totalGroups, totalSubjects }) {
    return (
        <div className="container text-center mt-5">
            <Head title="Dashboard Admin" />
            <h1 className="text-primary font-weight-bold">Welcome, {auth.user.name}!</h1>
            <p className="font-weight-bold">You are logged in as an admin.</p>
            
            <div className="stats-container d-flex justify-content-between mt-5 flex-wrap">
                <StatBox className="professor" icon="fas fa-chalkboard-teacher" label="Total Professors" value={totalProfs} />
                <StatBox className="admin" icon="fas fa-user-shield" label="Total Admins" value={totalAdmins} />
                <StatBox className="student" icon="fas fa-user-graduate" label="Total Students" value={totalEtudiants} />
                <StatBox className="groups" icon="fas fa-users" label="Total Groups" value={totalGroups} />
                <StatBox className="Subjects" icon="fas fa-book" label="Total Subjects" value={totalSubjects} />
            </div>
        </div>
    );
}

function StatBox({ className, icon, label, value }) {
    return (
        <div className={`stat-box ${className}`} style={styles.statBox}>
            <i className={`${icon} stat-icon`} style={styles.statIcon}></i>
            <p>{label}: {value}</p>
        </div>
    );
}

const styles = {
    statBox: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        flexDirection: 'column',
        padding: '20px',
        borderRadius: '10px',
        textAlign: 'center',
        minWidth: '250px',
        color: 'white',
        fontWeight: 'bold',
        boxShadow: '3px 3px 10px rgba(0, 0, 0, 0.1)',
        margin: '10px',
    },
    statIcon: {
        fontSize: '40px',
        marginBottom: '10px',
    }
};
